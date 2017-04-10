<?php

namespace app\repositories;

use app\models\User;

/**
 * Репозиторий юзеров
 */
class UsersRepository extends Repository {

    /** @return UsersRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:User'); }

    /**
     * @param int $id Id
     * @return null|User Пользователь
     */
    public function findUserById($id) {
        return $this->find(intval($id));
    }

    /**
     * @param string $email Email
     * @return null|User Пользователь
     */
    public function findUserByEmail($email) {
        return $this->findOneBy([
            'email' => $email,
        ]);
    }

    /**
     * @return User[] Клиенты
     */
    public function findAllClients() {
        return $this->findBy(['role' => User::ROLE_CLIENT], ['id' => 'desc']);
    }


    /**
     * @param int $limit
     * @return User[] Последние зарегестрированные клиены
     */
    public function findLastRegisteredClients($limit) {
        return $this->findBy(['role' => User::ROLE_CLIENT], ['id' => 'desc'], $limit);
    }

    /**
     * @param User $user Юзер
     * @return bool Результат операции
     */
    public function saveUser(User $user) {
        return $this->saveEntity($user);
    }

}
