<?php

use yii\db\Migration;

class m160726_162828_News extends Migration
{
    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `News` (
              `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
              `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `previewPath` VARCHAR(255) NOT NULL DEFAULT '',
              `bgpath` VARCHAR(255) NOT NULL DEFAULT '',
              `smallBgPath` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `NewsI18n` (
              `newsId` INT(9) unsigned NOT NULL COMMENT 'ID новости',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `shortDescription` TEXT NOT NULL,
              `description` TEXT NOT NULL,
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              PRIMARY KEY (`newsId`, `languageId`) USING BTREE,
              CONSTRAINT `NewsI18n_newsId` FOREIGN KEY (`newsId`) REFERENCES `News` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `NewsI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `NewsGallery` (
              `id` INT(9) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `newsId` INT(9) unsigned NOT NULL COMMENT 'ID новости',
              `sort` INT(9) unsigned NOT NULL COMMENT 'Сортировка',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `NewsGallery_newsId` FOREIGN KEY (`newsId`) REFERENCES `News` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `NewsGalleryImage` (
              `id` INT(9) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `galleryId` INT(9) unsigned NOT NULL COMMENT 'ID галереи',
              `sort` INT(9) unsigned NOT NULL COMMENT 'Сортировка',
              `smallPath` VARCHAR(255) NOT NULL DEFAULT '',
              `mediumPath` VARCHAR(255) NOT NULL DEFAULT '',
              `bigPath` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `NewsGalleryImage_galleryId` FOREIGN KEY (`galleryId`) REFERENCES `NewsGallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `NewsGalleryImageI18n` (
              `imageId` INT(9) unsigned NOT NULL COMMENT 'ID изображения',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`imageId`, `languageId`) USING BTREE,
              CONSTRAINT `NewsGalleryImageI18n_imageId` FOREIGN KEY (`imageId`) REFERENCES `NewsGalleryImage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `NewsGalleryImageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
