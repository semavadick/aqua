<?php

use yii\db\Migration;

class m161016_000355_AdditionProducts extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `AdditionProduct` (
              `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
              `categoryId` SMALLINT(5) unsigned DEFAULT NULL,
              `isOnOffer` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'На продаже',
              `sku` VARCHAR(255) DEFAULT '' COMMENT 'SKU',
              `price` decimal(10,2) NOT NULL DEFAULT '0.0' COMMENT 'Цена',
              `previewPath` VARCHAR(255) DEFAULT '' COMMENT 'Превью',
              `figure` VARCHAR(255) DEFAULT '' COMMENT 'код 3-d модели',
              `draftPath` VARCHAR(255) DEFAULT '' COMMENT 'Чертёж',
              `circuitPath` VARCHAR(255) DEFAULT '' COMMENT 'Схема',
              `certificatePath` VARCHAR(255) DEFAULT '' COMMENT 'Паспорт',
              `importId` VARCHAR(255) DEFAULT '',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `AdditionProduct_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `AdditionCategory` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionProductI18n` (
              `productId` INT(9) unsigned NOT NULL COMMENT 'ID товара',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `description` TEXT NOT NULL COMMENT 'Описание',
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              PRIMARY KEY (`productId`, `languageId`) USING BTREE,
              CONSTRAINT `AdditionProductI18n_productId` FOREIGN KEY (`productId`) REFERENCES `AdditionProduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionProductI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionProductRelation` (
              `productId` INT(9) unsigned NOT NULL,
              `relatedProductId` INT(9) unsigned NOT NULL,
              PRIMARY KEY (`productId`, `relatedProductId`) USING BTREE,
              CONSTRAINT `AdditionProductRelation_productId` FOREIGN KEY (`productId`) REFERENCES `AdditionProduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionProductRelation_relatedProductId` FOREIGN KEY (`relatedProductId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

             CREATE TABLE IF NOT EXISTS `AdditionProductAdditionRelation` (
              `productId` INT(9) unsigned NOT NULL,
              `relatedProductId` INT(9) unsigned NOT NULL,
              PRIMARY KEY (`productId`, `relatedProductId`) USING BTREE,
              CONSTRAINT `AdditionProductAdditionRelation_productId` FOREIGN KEY (`productId`) REFERENCES `AdditionProduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionProductAdditionRelation_relatedProductId` FOREIGN KEY (`relatedProductId`) REFERENCES `AdditionProduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionProductImage` (
              `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
              `productId` INT(9) UNSIGNED NOT NULL,
              `sort` INT(9) UNSIGNED NOT NULL DEFAULT '0',
              `smallPath` VARCHAR(255) DEFAULT '' COMMENT 'Маленькое изображение',
              `mediumPath` VARCHAR(255) DEFAULT '' COMMENT 'Среднее изображение',
              `bigPath` VARCHAR(255) DEFAULT '' COMMENT 'Большое изображение',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `AdditionProductImage_productId` FOREIGN KEY (`productId`) REFERENCES `AdditionProduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionProductImageI18n` (
              `imageId` INT(9) unsigned NOT NULL COMMENT 'ID изображения',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`imageId`, `languageId`) USING BTREE,
              CONSTRAINT `AdditionProductImageI18n_imageId` FOREIGN KEY (`imageId`) REFERENCES `AdditionProductImage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionProductImageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionProductTab` (
              `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
              `productId` INT(9) UNSIGNED NOT NULL,
              `sort` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `AdditionProductTab_productId` FOREIGN KEY (`productId`) REFERENCES `AdditionProduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionProductTabI18n` (
              `tabId` BIGINT(20) unsigned NOT NULL COMMENT 'ID вкладки',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название вкладки',
              `content` TEXT NOT NULL COMMENT 'Содержимое вкладки',
              PRIMARY KEY (`tabId`, `languageId`) USING BTREE,
              CONSTRAINT `AdditionProductTabI18n_tabId` FOREIGN KEY (`tabId`) REFERENCES `AdditionProductTab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionProductTabI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

             CREATE TABLE IF NOT EXISTS `AdditionProductOption` (
              `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
              `productId` INT(9) UNSIGNED NOT NULL,
              `sort` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
              `type` TINYINT(2) UNSIGNED DEFAULT '0',
              `main` TINYINT(1) UNSIGNED DEFAULT '0',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `AdditionProductOption_productId` FOREIGN KEY (`productId`) REFERENCES `AdditionProduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdditionProductOptionI18n` (
              `optionId` BIGINT(20) unsigned NOT NULL COMMENT 'ID опции',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` TEXT NOT NULL,
              `value` TEXT NOT NULL,
              PRIMARY KEY (`optionId`, `languageId`) USING BTREE,
              CONSTRAINT `AdditionProductOptionI18n_optionId` FOREIGN KEY (`optionId`) REFERENCES `AdditionProductOption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdditionProductOptionI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE `OrderAdditionProduct` (
              `id` INT(9) unsigned NOT NULL AUTO_INCREMENT,
              `orderId` bigint(19) unsigned NOT NULL COMMENT 'ID заказа',
              `productId` int(9) unsigned DEFAULT NULL COMMENT 'ID товара',
              `sku` varchar(255) NOT NULL DEFAULT '' COMMENT 'SKU товара',
              `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Название товара',
              `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Цена товара',
              `quantity` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Кол-во',
              `discount` decimal(5,2) DEFAULT NULL COMMENT 'Скидка',
              PRIMARY KEY (`id`),
              CONSTRAINT `OrderAdditionProduct_orderId` FOREIGN KEY (`orderId`) REFERENCES `Order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `OrderAdditionProduct_productId` FOREIGN KEY (`productId`) REFERENCES `AdditionProduct` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `OrderAdditionProductOption` (
              `productId` INT(9) UNSIGNED NOT NULL,
              `optionId` BIGINT(20) UNSIGNED NOT NULL,
              PRIMARY KEY (`productId`, `optionId`) USING BTREE,
              CONSTRAINT `OrderAdditionProductOption_productId` FOREIGN KEY (`productId`) REFERENCES `OrderAdditionProduct` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `OrderAdditionProductOption_optionId` FOREIGN KEY (`optionId`) REFERENCES `AdditionProductOption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");




        $cmd->execute();
        return true;

    }

    public function down()
    {
        return false;
    }
}
