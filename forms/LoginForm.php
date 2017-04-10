<?php

namespace app\forms;

use app\components\Doctrine;
use app\components\UserIdentity;
use app\models\User;
use app\repositories\SettingsRepository;
use app\repositories\UsersRepository;
use Yii;
use yii\swiftmailer\Mailer;

/**
 * Форма логина
 */
class LoginForm extends Form {

    /**
     * @var string Email
     */
    public $email;

    /**
     * @var string Password
     */
    public $password;

    /**
     * @var string Password
     */
    public $remember;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['remember', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'email' => Yii::t('app', 'E-mail'),
            'password' => Yii::t('app', 'Password'),
        ];
    }


    /**
     * @return User|null Объект пользователя
     */
    protected function getUser() {
        return UsersRepository::getInstance()->findUserByEmail($this->email);
    }

    /**
     * Метод для валидации пароля
     */
    public function validatePassword($attribute, $params) {
        $user = $this->getUser();
        if(empty($user) || !$user->validatePassword($this->password)) {
            $this->addError('password', Yii::t('app', 'Incorrect e-mail or password'));
        }
    }

    /**
     * Осуществляет вход пользователя
     * @return bool Результат операции
     */
    public function login() {
        if(!$this->validate()) {
            return false;
        }
        $user = $this->getUser();
        $identity = UserIdentity::findIdentity($user->getId());
        return Yii::$app->getUser()->login($identity, $this->remember ? 3600*24*10 : 3600);
    }

}