<?php

use app\models\Language;
use yii\db\Migration;

class m160723_115450_MainPageRefactoring extends Migration
{

    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `MainPageI18n` (
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Title',
              `metaKeywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Meta-keywords',
              `metaDescription` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Meta-description',
              `aboutTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Заголовок О компании',
              `aboutText` text NOT NULL COMMENT 'Текст О компании',
              PRIMARY KEY (`languageId`) USING BTREE,
              CONSTRAINT `MainPageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `MainPageI18n` (`languageId`, `aboutText`, `title`) VALUES (:ruId, '', :ruTitle), (:enId, '', :enTitle);

            DELETE FROM `MainPage` WHERE `languageId` != :ruId;
            ALTER TABLE `MainPage` DROP FOREIGN KEY `MainPage_languageId`;
            ALTER TABLE `MainPage` DROP COLUMN `languageId`;
            ALTER TABLE `MainPage` ADD COLUMN `id` SMALLINT(1) UNSIGNED NOT NULL;
            ALTER TABLE `MainPage` ADD PRIMARY KEY (`id`);

            ALTER TABLE `MainPage` DROP COLUMN `title`;
            ALTER TABLE `MainPage` DROP COLUMN `metaKeywords`;
            ALTER TABLE `MainPage` DROP COLUMN `metaDescription`;
            ALTER TABLE `MainPage` DROP COLUMN `aboutTitle`;
            ALTER TABLE `MainPage` DROP COLUMN `aboutText`;
            ALTER TABLE `MainPage` DROP COLUMN `aboutVideoCode`;
        ");
        $cmd->bindValues([
            ':ruId' => Language::ID_RU,
            ':ruTitle' => 'Главная страница',

            ':enId' => Language::ID_EN,
            ':enTitle' => 'Main page',
        ]);
        $cmd->execute();
        return true;
    }

    public function down() {
        echo 'Обратная миграция не поддерживается';
        return false;
    }
}
