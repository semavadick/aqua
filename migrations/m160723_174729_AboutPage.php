<?php

use app\models\Language;
use yii\db\Migration;

class m160723_174729_AboutPage extends Migration
{
    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `AboutPage` (
              `id` TINYINT(1) UNSIGNED NOT NULL,
              `competenceImagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение блока Наши компетенции',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AboutPageI18n` (
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',

              `menuName` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Название пункта в меню',
              `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Title',
              `metaKeywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Meta-keywords',
              `metaDescription` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Meta-description',

              `historyMenuName` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Название пункта в меню блока История',
              `historyImagePath` varchar(255) NOT NULL DEFAULT '' COMMENT 'Изображение блока История',

              `competenceMenuName` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Название пункта в меню блока Наши компетенции',
              `competenceTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Закголовок блока Наши компетенции',
              `competenceText` text NOT NULL COMMENT 'Текст блока Наши компетенции',

              `productionMenuName` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Название пункта в меню блока Производство',
              `productionTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Закголовок блока Производство',
              `productionText` text NOT NULL COMMENT 'Текст блока Производство',

              `advantagesMenuName` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Название пункта в меню блока Преимущества',
              `advantagesTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Закголовок блока Преимущества',

              `certificatesMenuName` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Название пункта в меню блока Сертификаты',
              `certificatesTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Закголовок блока Сертификаты',

              `newsMenuName` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Название пункта в меню блока Новости',
              `newsTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Закголовок блока Новости',

              `contactsMenuName` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Название пункта в меню блока Новости',
              `contactsTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Закголовок блока Новости',
              PRIMARY KEY (`languageId`) USING BTREE,
              CONSTRAINT `AboutPageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `AboutPage` (`id`) VALUES (0);
            INSERT INTO `AboutPageI18n` (`languageId`, `title`, `competenceText`, `productionText`) VALUES (:ruId, :ruTitle, '', ''), (:enId, :enTitle, '', '');
        ");
        $cmd->bindValues([
            ':ruId' => Language::ID_RU,
            ':ruTitle' => 'О компании',

            ':enId' => Language::ID_EN,
            ':enTitle' => 'About',
        ]);
        $cmd->execute();
        return true;
    }

    public function down() {
        echo 'Обратная миграция не поддерживается';
        return false;
    }

}
