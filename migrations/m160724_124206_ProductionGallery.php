<?php

use yii\db\Migration;

class m160724_124206_ProductionGallery extends Migration
{
    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `ProductionImage` (
              `id` TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `imagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение',
              `smallImagePath` VARCHAR(255) DEFAULT '' COMMENT 'Маленькое изображение',
              `mediumImagePath` VARCHAR(255) DEFAULT '' COMMENT 'Среднее изображение',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductionImageI18n` (
              `imageId` tinyint(2) unsigned NOT NULL COMMENT 'ID изображения',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` text NOT NULL COMMENT 'Текст',
              PRIMARY KEY (`imageId`, `languageId`) USING BTREE,
              CONSTRAINT `ProductionImageI18n_imageId` FOREIGN KEY (`imageId`) REFERENCES `ProductionImage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ProductionImageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
