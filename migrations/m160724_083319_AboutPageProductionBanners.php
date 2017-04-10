<?php

use yii\db\Migration;

class m160724_083319_AboutPageProductionBanners extends Migration
{
    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `ProductionBanner` (
              `id` TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `imagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductionBannerI18n` (
              `bannerId` tinyint(2) unsigned NOT NULL COMMENT 'ID баннера',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` text NOT NULL COMMENT 'Текст',
              `link` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Ссылка',
              PRIMARY KEY (`bannerId`, `languageId`) USING BTREE,
              CONSTRAINT `ProductionBannerI18n_bannerId` FOREIGN KEY (`bannerId`) REFERENCES `ProductionBanner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ProductionBannerI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
