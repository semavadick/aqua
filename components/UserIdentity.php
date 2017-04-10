<?php

namespace app\components;

use app\models\User;
use app\repositories\UsersRepository;
use yii\web\IdentityInterface;

/**
 * Компонент identity пользователя
 */
class UserIdentity implements IdentityInterface
{

    /**
     * @var int ID
     */
    private $_id;

    /**
     * @var string Auth key
     */
    private $_authKey;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = UsersRepository::getInstance()->findUserById($id);
        if(empty($user)) {
            return null;
        }
        return self::_createFromUser($user);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->_generateAuthKeyHash($this->_authKey);
    }

    /**
     * @param string $authKey Ключ доступа
     * @return string Уникальный хеш для ключа доступа
     */
    private function _generateAuthKeyHash($authKey)
    {
        $secretKey = \Yii::$app->params['autoLoginSecretKey'];
        return md5($secretKey . $authKey);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->_generateAuthKeyHash($this->_authKey) == $authKey;
    }

    /**
     * Создает identity из объекта пользователя
     *
     * @param User $user
     * @return static
     */
    private static function _createFromUser(User $user)
    {
        $identity = new self();
        $identity->_id = $user->getId();
        $identity->_authKey = $user->getAuthKey();
        return $identity;
    }

    /**
     * Регенерирует ключ для авторизации через куки
     * @return bool
     */
    public function regenerateAuthKey()
    {
        $rep = UsersRepository::getInstance();
        $user = UsersRepository::getInstance()->findUserById($this->getId());
        if(empty($user)) {
            return false;
        }
        $this->_authKey = uniqid();
        $user->setAuthKey($this->_authKey);
        return $rep->saveUser($user);
    }

} 