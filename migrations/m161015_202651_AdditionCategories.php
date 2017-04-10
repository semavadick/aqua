<?php

use yii\db\Migration;

class m161015_202651_AdditionCategories extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `AdditionCategory` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `parentId` SMALLINT(5) unsigned DEFAULT NULL,
              `imagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение',
              `bgPath` VARCHAR(255) DEFAULT '' COMMENT 'Фон',
              `smallBgPath` VARCHAR(255) DEFAULT '' COMMENT 'Маленький фон',
              `hasDiscount` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Разрешена особая скидка',
              `importId` VARCHAR(255) DEFAULT '',
              `sort` SMALLINT(5) UNSIGNED DEFAULT '0' COMMENT 'Сортировка',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `AdditionCategory_parentId` FOREIGN KEY (`parentId`) REFERENCES `AdditionCategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionCategoryRelation` (
              `categoryId` SMALLINT(5) unsigned NOT NULL,
              `relatedAdditionCategoryId` SMALLINT(5) unsigned NOT NULL,
              PRIMARY KEY (`categoryId`, `relatedAdditionCategoryId`) USING BTREE,
              CONSTRAINT `AdditionCategoryRelation_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `AdditionCategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionCategoryRelation_relatedAdditionCategoryId` FOREIGN KEY (`relatedAdditionCategoryId`) REFERENCES `AdditionCategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionCategoryI18n` (
              `categoryId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID категории',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `description` TEXT NOT NULL COMMENT 'Описание',
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              PRIMARY KEY (`categoryId`, `languageId`) USING BTREE,
              CONSTRAINT `AdditionCategoryI18n_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `AdditionCategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionCategoryI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionCategoryFilter` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `categoryId` SMALLINT(5) UNSIGNED NOT NULL,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `AdditionCategoryFilter_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `AdditionCategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionCategoryFilterI18n` (
              `filterId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID фильтра',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` TEXT NOT NULL COMMENT 'Текст',
              PRIMARY KEY (`filterId`, `languageId`) USING BTREE,
              CONSTRAINT `AdditionCategoryFilterI18n_filterId` FOREIGN KEY (`filterId`) REFERENCES `AdditionCategoryFilter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionCategoryFilterI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
