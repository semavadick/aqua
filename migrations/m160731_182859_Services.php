<?php

use yii\db\Migration;

class m160731_182859_Services extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `Service` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `bgPath` VARCHAR(255) DEFAULT '' COMMENT 'Фон',
              `smallBgPath` VARCHAR(255) DEFAULT '' COMMENT 'Маленький фон',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ServiceI18n` (
              `serviceId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID услуги',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `description` TEXT NOT NULL COMMENT 'Описание',
              `additDescription` TEXT NOT NULL COMMENT 'Доп. описание',
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              PRIMARY KEY (`serviceId`, `languageId`) USING BTREE,
              CONSTRAINT `ServiceI18n_serviceId` FOREIGN KEY (`serviceId`) REFERENCES `Service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ServiceI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `Service` (`id`) VALUES (1), (2);

            CREATE TABLE IF NOT EXISTS `ServiceAdvantage` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `serviceId` SMALLINT(5) UNSIGNED NOT NULL,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `iconPath` VARCHAR(255) DEFAULT '' COMMENT 'Иконка',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `ServiceAdvantage_serviceId` FOREIGN KEY (`serviceId`) REFERENCES `Service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ServiceAdvantageI18n` (
              `advantageId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID преимущества',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` TEXT NOT NULL COMMENT 'Текст',
              PRIMARY KEY (`advantageId`, `languageId`) USING BTREE,
              CONSTRAINT `ServiceAdvantageI18n_serviceId` FOREIGN KEY (`advantageId`) REFERENCES `ServiceAdvantage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ServiceAdvantageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }
}
