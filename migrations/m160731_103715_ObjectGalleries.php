<?php

use yii\db\Migration;

class m160731_103715_ObjectGalleries extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `ObjectGallery` (
              `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `isTop` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
              `isExclusive` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
              `coordsLat` decimal(10,8) NOT NULL DEFAULT '0' COMMENT 'Широта (коорд.)',
              `coordsLng` decimal(11,8) NOT NULL DEFAULT '0' COMMENT 'Долгота (коорд.)',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ObjectGalleryI18n` (
              `galleryId` INT(9) unsigned NOT NULL COMMENT 'ID типа',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `shortDescription` TEXT NOT NULL COMMENT 'Краткое описание',
              `description` TEXT NOT NULL COMMENT 'Описание',
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              `address` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Адрес',
              PRIMARY KEY (`galleryId`, `languageId`) USING BTREE,
              CONSTRAINT `ObjectGalleryI18n_galleryId` FOREIGN KEY (`galleryId`) REFERENCES `ObjectGallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ObjectGalleryI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ObjectGalleryImage` (
              `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
              `galleryId` INT(9) UNSIGNED NOT NULL,
              `sort` INT(9) UNSIGNED NOT NULL DEFAULT '0',
              `smallPath` VARCHAR(255) DEFAULT '' COMMENT 'Маленькое изображение',
              `mediumPath` VARCHAR(255) DEFAULT '' COMMENT 'Среднее изображение',
              `bigPath` VARCHAR(255) DEFAULT '' COMMENT 'Большое изображение',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `ObjectGalleryImage_galleryId` FOREIGN KEY (`galleryId`) REFERENCES `ObjectGallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


            CREATE TABLE IF NOT EXISTS `ObjectGalleryType` (
              `galleryId` INT(9) unsigned NOT NULL COMMENT 'ID типа',
              `typeId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID типа',
              PRIMARY KEY (`galleryId`, `typeId`) USING BTREE,
              CONSTRAINT `ObjectGalleryType_galleryId` FOREIGN KEY (`galleryId`) REFERENCES `ObjectGallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ObjectGalleryType_typeId` FOREIGN KEY (`typeId`) REFERENCES `PoolType` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }
}
