<?php

use yii\db\Migration;

class m160721_224743_MainPageI18n extends Migration
{

    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `MainPageSlideI18n` (
              `slideId` tinyint(3) unsigned NOT NULL COMMENT 'ID слайда',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` text NOT NULL COMMENT 'Текст',
              `link` text NOT NULL COMMENT 'Ссылка',
              PRIMARY KEY (`slideId`, `languageId`) USING BTREE,
              CONSTRAINT `MainPageSlideI18n_slideId` FOREIGN KEY (`slideId`) REFERENCES `MainPageSlide` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `MainPageSlideI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE IF NOT EXISTS `MainPageBannerI18n` (
              `bannerId` tinyint(3) unsigned NOT NULL COMMENT 'ID баннера',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` text NOT NULL COMMENT 'Текст',
              `link` text NOT NULL COMMENT 'Ссылка',
              PRIMARY KEY (`bannerId`, `languageId`) USING BTREE,
              CONSTRAINT `MainPageBannerI18n_bannerId` FOREIGN KEY (`bannerId`) REFERENCES `MainPageBanner` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `MainPageBannerI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            ALTER TABLE `MainPageSlide` DROP COLUMN `text`;
            ALTER TABLE `MainPageSlide` DROP FOREIGN KEY `MainPageSlide_pageId`;
            ALTER TABLE `MainPageSlide` DROP COLUMN `pageId`;

            ALTER TABLE `MainPageBanner` DROP COLUMN `text`;
            ALTER TABLE `MainPageBanner` DROP COLUMN `link`;
            ALTER TABLE `MainPageBanner` DROP FOREIGN KEY `MainPageBanner_pageId`;
            ALTER TABLE `MainPageBanner` DROP COLUMN `pageId`;

            ALTER TABLE `MainPage` DROP COLUMN `id`, ADD PRIMARY KEY(`languageId`);
        ");
        $cmd->execute();
        return true;
    }

    public function down() {
        echo 'Обратная миграция не поддерживается';
        return false;
    }
}
