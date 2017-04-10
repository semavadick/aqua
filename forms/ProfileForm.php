<?php

namespace app\forms;

use app\components\Doctrine;
use app\models\User;
use Yii;

/**
 * Форма редактирования профиля
 */
class ProfileForm extends Form {

    /**
     * @var string Имя и фамилия
     */
    public $fullName;

    /**
     * @var string Телефон
     */
    public $phone;

    /**
     * @var string Название компании
     */
    public $companyName;

    /**
     * @var string Email
     */
    public $email;

    /**
     * @var User Юзер
     */
    protected $user;

    /**
     * @inheritdoc
     */
    public function rules() {
        $rules = [
            [['fullName', 'phone'], 'required']
        ];
        if($this->isCompany()) {
            $rules[] = ['companyName', 'required'];
        }
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'fullName' => Yii::t('app', 'Your full name'),
            'email' => Yii::t('app', 'E-mail'),
            'phone' => Yii::t('app', 'Phone'),
            'companyName' => Yii::t('app', 'Company name'),
        ];
    }

    /**
     * Сохраняет данные пользователя
     * @return bool
     */
    public function save() {
        if(!$this->validate()) {
            return false;
        }

        /** @var Doctrine $doctrine */
        $doctrine = Yii::$app->get('doctrine');
        $em = $doctrine->getEntityManager();
        $user = $this->user;
        $em->persist($user);
        $user->setFullName($this->fullName);
        $user->setPhone($this->phone);
        if(!empty($this->companyName)) {
            $user->setCompanyName($this->companyName);
        }
        $em->flush();

        return true;
    }

    /** @param User $user */
    public function setUser($user) {
        $this->user = $user;
        $this->fullName = $user->getFullName();
        $this->phone = $user->getPhone();
        $this->email = $user->getEmail();
        $this->companyName = $user->getCompanyName();
    }

    public function isCompany() {
        return $this->user->getType() == User::TYPE_COMPANY;
    }

}