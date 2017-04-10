<?php

use yii\db\Migration;

class m160802_193616_Categories extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `Category` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `parentId` SMALLINT(5) unsigned DEFAULT NULL,
              `imagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение',
              `bgPath` VARCHAR(255) DEFAULT '' COMMENT 'Фон',
              `smallBgPath` VARCHAR(255) DEFAULT '' COMMENT 'Маленький фон',
              `sort` SMALLINT(5) UNSIGNED DEFAULT '0' COMMENT 'Сортировка',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `Category_parentId` FOREIGN KEY (`parentId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `CategoryRelation` (
              `categoryId` SMALLINT(5) unsigned NOT NULL,
              `relatedCategoryId` SMALLINT(5) unsigned NOT NULL,
              PRIMARY KEY (`categoryId`, `relatedCategoryId`) USING BTREE,
              CONSTRAINT `CategoryRelation_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `CategoryRelation_relatedCategoryId` FOREIGN KEY (`relatedCategoryId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `CategoryI18n` (
              `categoryId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID категории',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `description` TEXT NOT NULL COMMENT 'Описание',
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              PRIMARY KEY (`categoryId`, `languageId`) USING BTREE,
              CONSTRAINT `CategoryI18n_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `CategoryI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `CategoryFilter` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `categoryId` SMALLINT(5) UNSIGNED NOT NULL,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `CategoryFilter_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `CategoryFilterI18n` (
              `filterId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID фильтра',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` TEXT NOT NULL COMMENT 'Текст',
              PRIMARY KEY (`filterId`, `languageId`) USING BTREE,
              CONSTRAINT `CategoryFilterI18n_filterId` FOREIGN KEY (`filterId`) REFERENCES `CategoryFilter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `CategoryFilterI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160803_193616_Categories cannot be reverted.\n";

        return false;
    }
}
