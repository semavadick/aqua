<?php

use yii\db\Migration;

class m160727_183816_Articles extends Migration
{
    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `Article` (
              `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
              `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `previewPath` VARCHAR(255) NOT NULL DEFAULT '',
              `bgpath` VARCHAR(255) NOT NULL DEFAULT '',
              `smallBgPath` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ArticleI18n` (
              `articleId` INT(9) unsigned NOT NULL COMMENT 'ID статьи',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `shortDescription` TEXT NOT NULL,
              `description` TEXT NOT NULL,
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              PRIMARY KEY (`articleId`, `languageId`) USING BTREE,
              CONSTRAINT `ArticleI18n_articleId` FOREIGN KEY (`articleId`) REFERENCES `Article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ArticleI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ArticleGallery` (
              `id` INT(9) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `articleId` INT(9) unsigned NOT NULL COMMENT 'ID статьи',
              `sort` INT(9) unsigned NOT NULL COMMENT 'Сортировка',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `ArticleGallery_articleId` FOREIGN KEY (`articleId`) REFERENCES `Article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ArticleGalleryImage` (
              `id` INT(9) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `galleryId` INT(9) unsigned NOT NULL COMMENT 'ID галереи',
              `sort` INT(9) unsigned NOT NULL COMMENT 'Сортировка',
              `smallPath` VARCHAR(255) NOT NULL DEFAULT '',
              `mediumPath` VARCHAR(255) NOT NULL DEFAULT '',
              `bigPath` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `ArticleGalleryImage_galleryId` FOREIGN KEY (`galleryId`) REFERENCES `ArticleGallery` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ArticleGalleryImageI18n` (
              `imageId` INT(9) unsigned NOT NULL COMMENT 'ID изображения',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`imageId`, `languageId`) USING BTREE,
              CONSTRAINT `ArticleGalleryImageI18n_imageId` FOREIGN KEY (`imageId`) REFERENCES `ArticleGalleryImage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ArticleGalleryImageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
