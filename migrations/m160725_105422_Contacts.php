<?php

use yii\db\Migration;

class m160725_105422_Contacts extends Migration
{
    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `OfficeRegion` (
              `id` TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `OfficeRegionI18n` (
              `regionId` tinyint(2) unsigned NOT NULL COMMENT 'ID региона',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              PRIMARY KEY (`regionId`, `languageId`) USING BTREE,
              CONSTRAINT `OfficeRegionI18n_regionId` FOREIGN KEY (`regionId`) REFERENCES `OfficeRegion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `OfficeRegionI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `Office` (
              `id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `regionId` tinyint(2) unsigned DEFAULT NULL COMMENT 'ID региона',
              `coordsLat` decimal(10,8) NOT NULL DEFAULT '0' COMMENT 'Широта (коорд.)',
              `coordsLng` decimal(11,8) NOT NULL DEFAULT '0' COMMENT 'Долгота (коорд.)',
              `phone` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Телефон',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `Office_regionId` FOREIGN KEY (`regionId`) REFERENCES `OfficeRegion` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `OfficeI18n` (
              `officeId` tinyint(3) unsigned NOT NULL COMMENT 'ID офиса',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `address` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Адрес',
              `email` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'E-mail',
              `phoneComment` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Комментарий к телефону',
              `comment` text NOT NULL COMMENT 'Комментарий',
              PRIMARY KEY (`officeId`, `languageId`) USING BTREE,
              CONSTRAINT `OfficeI18n_officeId` FOREIGN KEY (`officeId`) REFERENCES `Office` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `OfficeI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }

    public function down() {
        echo 'Обратная миграция не поддерживается';
        return false;
    }
}
