<?php

use app\models\Language;
use yii\db\Migration;

class m160805_071712_Products extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `Product` (
              `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
              `categoryId` SMALLINT(5) unsigned DEFAULT NULL,
              `isOnOffer` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'На продаже',
              `sku` VARCHAR(255) DEFAULT '' COMMENT 'SKU',
              `price` decimal(10,2) NOT NULL DEFAULT '0.0' COMMENT 'Цена',
              `previewPath` VARCHAR(255) DEFAULT '' COMMENT 'Превью',
              `figurePath` VARCHAR(255) DEFAULT '' COMMENT '3D модель',
              `draftPath` VARCHAR(255) DEFAULT '' COMMENT 'Чертёж',
              `circuitPath` VARCHAR(255) DEFAULT '' COMMENT 'Схема',
              `certificatePath` VARCHAR(255) DEFAULT '' COMMENT 'Паспорт',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `Product_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `Category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductI18n` (
              `productId` INT(9) unsigned NOT NULL COMMENT 'ID товара',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `description` TEXT NOT NULL COMMENT 'Описание',
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              PRIMARY KEY (`productId`, `languageId`) USING BTREE,
              CONSTRAINT `ProductI18n_productId` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ProductI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductRelation` (
              `productId` INT(9) unsigned NOT NULL,
              `relatedProductId` INT(9) unsigned NOT NULL,
              PRIMARY KEY (`productId`, `relatedProductId`) USING BTREE,
              CONSTRAINT `ProductRelation_productId` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ProductRelation_relatedProductId` FOREIGN KEY (`relatedProductId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductFilter` (
              `productId` INT(9) UNSIGNED NOT NULL,
              `filterId` SMALLINT(5) UNSIGNED NOT NULL,
              PRIMARY KEY (`productId`, `filterId`) USING BTREE,
              CONSTRAINT `ProductFilter_productId` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ProductFilter_filterId` FOREIGN KEY (`filterId`) REFERENCES `CategoryFilter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE IF NOT EXISTS `ProductImage` (
              `id` INT(9) UNSIGNED NOT NULL AUTO_INCREMENT,
              `productId` INT(9) UNSIGNED NOT NULL,
              `sort` INT(9) UNSIGNED NOT NULL DEFAULT '0',
              `smallPath` VARCHAR(255) DEFAULT '' COMMENT 'Маленькое изображение',
              `mediumPath` VARCHAR(255) DEFAULT '' COMMENT 'Среднее изображение',
              `bigPath` VARCHAR(255) DEFAULT '' COMMENT 'Большое изображение',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `ProductImage_productId` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductImageI18n` (
              `imageId` INT(9) unsigned NOT NULL COMMENT 'ID изображения',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`imageId`, `languageId`) USING BTREE,
              CONSTRAINT `ProductImageI18n_imageId` FOREIGN KEY (`imageId`) REFERENCES `ProductImage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ProductImageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductAttribute` (
              `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
              `productId` INT(9) UNSIGNED NOT NULL,
              `sort` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `ProductAttribute_productId` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductAttributeI18n` (
              `attributeId` BIGINT(20) unsigned NOT NULL COMMENT 'ID атрибута',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` TEXT NOT NULL,
              `value` TEXT NOT NULL,
              PRIMARY KEY (`attributeId`, `languageId`) USING BTREE,
              CONSTRAINT `ProductAttributeI18n_attributeId` FOREIGN KEY (`attributeId`) REFERENCES `ProductAttribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ProductAttributeI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `Attachment` (
              `id` INT(9) unsigned NOT NULL AUTO_INCREMENT,
              `sort` INT(9) UNSIGNED NOT NULL DEFAULT '0',
              `iconPath` VARCHAR(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AttachmentI18n` (
              `attachmentId` INT(9) unsigned NOT NULL,
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` TEXT NOT NULL,
              PRIMARY KEY (`attachmentId`, `languageId`) USING BTREE,
              CONSTRAINT `AttachmentI18n_attachmentId` FOREIGN KEY (`attachmentId`) REFERENCES `Attachment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AttachmentI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ProductAttachment` (
              `productId` INT(9) UNSIGNED NOT NULL,
              `attachmentId` INT(9) UNSIGNED NOT NULL,
              PRIMARY KEY (`productId`, `attachmentId`) USING BTREE,
              CONSTRAINT `ProductAttachment_productId` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ProductAttachment_attachmentId` FOREIGN KEY (`attachmentId`) REFERENCES `Attachment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `CatalogPage` (
              `id` TINYINT(1) UNSIGNED NOT NULL,
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `CatalogPageI18n` (
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `deliveryDescription` TEXT NOT NULL,
              `catalogImagePath` varchar(255) NOT NULL DEFAULT '',
              `catalogFilePath` varchar(255) NOT NULL DEFAULT '',
              `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Title',
              `metaKeywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Meta-keywords',
              `metaDescription` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Meta-description',
              PRIMARY KEY (`languageId`) USING BTREE,
              CONSTRAINT `CatalogPageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `CatalogPage` (`id`) VALUES (0);
            INSERT INTO `CatalogPageI18n` (`languageId`, `title`, `deliveryDescription`) VALUES (:ruId, :ruTitle, ''), (:enId, :enTitle, '');
            ");
        $cmd->bindValues([
            ':ruId' => Language::ID_RU,
            ':ruTitle' => 'Каталог',

            ':enId' => Language::ID_EN,
            ':enTitle' => 'Store',
        ]);
        $cmd->execute();
        return true;

    }

    public function down()
    {
        echo "m160808_071712_Products cannot be reverted.\n";

        return false;
    }
}
