<?php

use yii\db\Migration;

/**
 * Миграция для добавления таблицы юзеров
 */
class m160715_210257_Base extends Migration {

    private $table = 'User';

    public function up() {
        $table = $this->table;
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `{$table}` (
              `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `email` varchar(255) NOT NULL DEFAULT '' COMMENT 'Email',
              `fullName` varchar(255) NOT NULL DEFAULT '' COMMENT 'Имя и фамилия',
              `role` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Роль пользователя (0 - юзер, 1 - модер, 2 - админ)',
              `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Статус пользователя (0 - не подтвержден, 1 - активный, 2 - заблокирован)',
              `passwordHash` varchar(255) NOT NULL DEFAULT '' COMMENT 'Пароль',
              `authKey` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ключ для аутентификации по cookie',
              `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата регистрации',
              PRIMARY KEY (`id`),
              UNIQUE KEY `email` (`email`) USING BTREE,
              KEY `registered` (`registered`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        ");
        $cmd->execute();

        $user = new \app\models\User();
        $user->setEmail('dev@2funky.ru');
        $user->setFullName('Test User');
        $user->setStatus($user::STATUS_ACTIVE);
        $user->setRole($user::ROLE_ADMIN);
        $user->setPassword('2funkydev');

        $cmd = $db->createCommand("
            INSERT INTO `{$table}` (`email`, `passwordHash`, `fullName`, `status`, `role`) VALUES(:email, :passwordHash, :fullName, :statusCode, :role);

        ");
        $cmd->bindValues([
            ':email' => $user->getEmail(),
            ':passwordHash' => $user->getPasswordHash(),
            ':fullName' => $user->getFullName(),
            ':statusCode' => $user->getStatus(),
            ':role' => $user->getRole(),
        ]);
        $cmd->execute();
        return true;
    }

    public function down() {
        $table = $this->table;
        $db = $this->getDb();
        $cmd = $db->createCommand("
            DROP TABLE `{$table}`;
        ");
        $cmd->execute();
        return true;
    }
}
