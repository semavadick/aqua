<?php

namespace app\forms;

use app\components\Doctrine;
use app\models\User;
use app\repositories\SettingsRepository;
use app\repositories\UsersRepository;
use back\helpers\HandyFile;
use app\validators\ModelFile;
use Yii;
use yii\swiftmailer\Mailer;

/**
 * Форма регистрации
 */
class RegistrationForm extends Form {

    /**
     * @var string Имя и фамилия
     */
    public $fullName;

    /**
     * @var string Телефон
     */
    public $phone;

    /**
     * @var string Email
     */
    public $email;

    /** @var HandyFile|null */
    public $uFile;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fullName', 'email', 'phone'], 'required'],
            ['email', 'email'],
            ['email', 'checkEmail'],
            ['uFile', ModelFile::className()],
        ];
    }

    public function checkEmail() {
        $email = trim($this->email);
        $user = UsersRepository::getInstance()->findUserByEmail($email);
        if(empty($user)) {
            return;
        }
        if(empty($this->user) || $this->user->getId() != $user->getId()) {
            $this->addError('email', 'Пользоваетль с таким email уже существует');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'fullName' => Yii::t('app', 'Your full name'),
            'email' => Yii::t('app', 'E-mail'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    /** @param array */
    public function loadFile($data) {
        if(!empty($data['uFile']['tmp_name']) && !empty($data['uFile']['name'])) {
            $this->uFile = HandyFile::createFromPath($data['uFile']['tmp_name'], $data['uFile']['name']);
        } else {
            $this->uFile = null;
        }
    }

    /**
     * Регистрирует пользователя
     * @return bool Результат операции
     */
    public function register() {
        if(!$this->validate()) {
            return false;
        }

        /** @var Doctrine $doctrine */
        $doctrine = Yii::$app->get('doctrine');
        $em = $doctrine->getEntityManager();
        $setting = SettingsRepository::getInstance()->findSetting();
        /* @var Mailer $mailer */
        $mailer = Yii::$app->get('mailer');

        $user = new User();
        $user->setFullName($this->fullName);
        $user->setEmail($this->email);
        $user->setPhone($this->phone);
        $user->setStatus($user::STATUS_ACTIVE);
        $user->setRole($user::ROLE_CLIENT);
        $password = uniqid();
        $user->setPassword($password);
        if(!empty($this->uFile)) {
            $path = $this->uFile->saveToDir('/files/users', true);
            if(empty($path)) {
                $this->addError('uFile', 'Не удалось сохранить файл');
                return false;
            }
            $user->setCompanyInfoFilePath($path);
        }
        $em->persist($user);
        $em->flush();

        $message = $mailer->compose('users/registration', [
            'fullName' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $password,
        ]);
        $message
            ->setFrom($setting->getNoreplyEmail())
            ->setTo($user->getEmail())
            ->send();

        // TODO
        /*$message = $mailer->compose('managers/registration', [
            'fullName' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $message
            ->setFrom($setting->getNoreplyEmail())
            ->setTo($user->getFeedbackEmail())
            ->send();*/


        return true;
    }
}