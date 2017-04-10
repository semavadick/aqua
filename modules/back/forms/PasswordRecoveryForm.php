<?php

namespace back\forms;

use app\repositories\UsersRepository;
use back\Module;
use yii\base\Model;
use yii\helpers\BaseUrl;
use yii\swiftmailer\Mailer;

/**
 * Класс для работы с формой восстановления пароля
 */
class PasswordRecoveryForm extends Model {

    /**
     * @var string Email пользователя
     */
    public $email;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['email', 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Отправляет email с инструкциями для восстановления пароля
     * @return bool Результат операции
     */
    public function sendRecoveryEmail() {
        if(!$this->validate()) {
            return false;
        }
        $user = UsersRepository::getInstance()->findUserByEmail($this->email);
        if(empty($user)) {
            $this->addError('email', 'Пользователя с указанным email не существует');
            return false;
        }

        /* @var Mailer $mailer */
        $mailer = Module::getInstance()->get('mailer');
        $message = $mailer->compose('admins/passwordRecovery', [
            'link' => BaseUrl::to([
                '/back-office/auth/password-reset',
                'i' => $user->getId(),
                't' => PasswordResetForm::getResetToken($user),
            ], true),
        ]);
        return $message
            ->setTo($user->getEmail())
            ->send();

    }

}