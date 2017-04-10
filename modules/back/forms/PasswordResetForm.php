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
class PasswordResetForm extends Model {

    /**
     * @var string Пароль пользователя
     */
    public $userId;

    /**
     * @var string Пароль пользователя
     */
    public $resetToken;

    /**
     * @var string Пароль пользователя
     */
    public $password;

    /**
     * @var string Пароль еще раз
     */
    public $password2;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['userId', 'resetToken', 'password', 'password2'], 'required'],
            ['password2', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли должны совпадать'],
            ['resetToken', 'checkResetToken'],
        ];
    }

    /**
     * Метод валидации. Проверяет указанный код
     * для смены пароля пользователя
     */
    public function checkResetToken() {
        $user = $this->getUser();
        $result = !empty($user) && self::getResetToken($user) === $this->resetToken;
        if(!$result) {
            $this->addError('resetToken', 'Неверный код для смены пароля. Проверьте ссылку, которая пришла вам на email.');
        }
    }

    /**
     * Возвращает токен для смены пароля юзера
     * @param User $user
     * @return string
     */
    public static function getResetToken(User $user) {
        return md5($user->getPasswordHash());
    }

    /**
     * Сбрасывает пароль пользователя
     * @return bool
     */
    public function resetPassword() {
        $user = $this->getUser();
        if(!$this->validate() || empty($user)) {
            return false;
        }
        $user->setPassword($this->password);
        return UsersRepository::getInstance()->saveUser($user);
    }

    /** @return User|null */
    private function getUser() {
        return UsersRepository::getInstance()->findUserById($this->userId);
    }

}