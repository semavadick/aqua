<?php

namespace back\forms;

use app\components\UserIdentity;
use app\components\WebUser;
use app\models\User;
use app\repositories\UsersRepository;
use yii\base\Model;

/**
 * Класс для работы с формой логина
 */
class LoginForm extends Model {

    /**
     * @var string Email пользователя
     */
    public $email;

    /**
     * @var string Пароль пользователя
     */
    public $password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Метод для валидации пароля
     *
     * @param string $attribute Имя атрибута
     * @param array $params Параметры для валидации
     */
    public function validatePassword($attribute, $params) {
        $user = $this->getUser();
        if(empty($user) || !$user->validatePassword($this->password)) {
            $this->addError('password', 'Неверный email или пароль');
        }
    }

    /**
     * Логинит пользователя
     *
     * @return bool
     */
    public function login() {
        if(!$this->validate()) {
            return false;
        }
        $user = $this->getUser();
        $identity = UserIdentity::findIdentity($user->getId());
        /** @var WebUser $wUser */
        $wUser = \Yii::$app->getUser();
        return $wUser->login($identity, 3600*24*10);
    }

    /**
     * @return User|null Объект пользователя
     */
    protected function getUser() {
        return UsersRepository::getInstance()->findUserByEmail($this->email);
    }

}