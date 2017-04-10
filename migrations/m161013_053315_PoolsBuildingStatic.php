<?php

use yii\db\Migration;

class m161013_053315_PoolsBuildingStatic extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `PoolsBuildingStatic` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `bgPath` VARCHAR(255) DEFAULT '' COMMENT 'Фон',
              `smallBgPath` VARCHAR(255) DEFAULT '' COMMENT 'Маленький фон',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `PoolsBuildingStaticI18n` (
              `poolsBuildingStaticId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID статической страницы',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL COMMENT 'Название',
              `shortDescription` TEXT DEFAULT NULL,
              `description` TEXT DEFAULT NULL COMMENT 'Описание',
              `slug` VARCHAR(255) DEFAULT NULL,
              `pageTitle` VARCHAR(255) DEFAULT NULL,
              `pageMetaKeywords` VARCHAR(255) DEFAULT NULL,
              `pageMetaDescription` TEXT DEFAULT NULL,
              PRIMARY KEY (`poolsBuildingStaticId`, `languageId`) USING BTREE,
              CONSTRAINT `PoolsBuildingStaticI18n_poolsBuildingStaticId` FOREIGN KEY (`poolsBuildingStaticId`) REFERENCES `PoolsBuildingStatic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `PoolsBuildingStaticI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `PoolsBuildingStaticGallery` (
              `id` INT(9) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `poolsBuildingStaticId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID статической страницы',
              `sort` INT(9) unsigned DEFAULT NULL COMMENT 'Сортировка',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `PoolsBuildingStaticGallery_poolsBuildingStaticId` FOREIGN KEY (`poolsBuildingStaticId`) REFERENCES `PoolsBuildingStatic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `PoolsBuildingStaticGalleryImage` (
              `id` INT(9) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `galleryId` INT(9) unsigned NOT NULL COMMENT 'ID галереи',
              `sort` INT(9) unsigned DEFAULT NULL COMMENT 'Сортировка',
              `smallPath` VARCHAR(255)  DEFAULT '',
              `mediumPath` VARCHAR(255) DEFAULT '',
              `bigPath` VARCHAR(255) DEFAULT '',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `PoolsBuildingStaticGalleryImage_galleryId` FOREIGN KEY (`galleryId`) REFERENCES `PoolsBuildingStaticGallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `PoolsBuildingStaticGalleryImageI18n` (
              `imageId` INT(9) unsigned NOT NULL COMMENT 'ID изображения',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) DEFAULT '',
              PRIMARY KEY (`imageId`, `languageId`) USING BTREE,
              CONSTRAINT `PoolsBuildingStaticGalleryImageI18n_imageId` FOREIGN KEY (`imageId`) REFERENCES `PoolsBuildingStaticGalleryImage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `PoolsBuildingStaticGalleryImageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `PoolsBuildingStatic` (`id`) VALUES (1);
            INSERT INTO `PoolsBuildingStaticI18n` (`poolsBuildingStaticId`,`languageId`,`name`,`pageTitle`) VALUES (1,1,`Реконструкция`,`Реконструкция`);
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m161013_053315_PoolsBuildingStatic cannot be reverted.\n";

        return false;
    }

}
