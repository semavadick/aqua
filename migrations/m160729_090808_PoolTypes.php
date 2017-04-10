<?php

use yii\db\Migration;

class m160729_090808_PoolTypes extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `PoolType` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `previewPath` VARCHAR(255) DEFAULT '' COMMENT 'Превью',
              `widePreviewPath` VARCHAR(255) DEFAULT '' COMMENT 'Широкое превью',
              `bgPath` VARCHAR(255) DEFAULT '' COMMENT 'Фон',
              `smallBgPath` VARCHAR(255) DEFAULT '' COMMENT 'Маленький фон',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `PoolTypeI18n` (
              `typeId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID типа',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `description` TEXT NOT NULL COMMENT 'Описание',
              `stagesPath` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Этапы строительства',
              `slug` VARCHAR(255) NOT NULL DEFAULT '',
              `pageTitle` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaKeywords` VARCHAR(255) NOT NULL DEFAULT '',
              `pageMetaDescription` TEXT NOT NULL,
              PRIMARY KEY (`typeId`, `languageId`) USING BTREE,
              CONSTRAINT `PoolTypeI18n_typeId` FOREIGN KEY (`typeId`) REFERENCES `PoolType` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `PoolTypeI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `TypeAdvantage` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `typeId` SMALLINT(5) UNSIGNED NOT NULL,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `iconPath` VARCHAR(255) DEFAULT '' COMMENT 'Иконка',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `TypeAdvantage_typeId` FOREIGN KEY (`typeId`) REFERENCES `PoolType` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `TypeAdvantageI18n` (
              `advantageId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID преимущества',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` TEXT NOT NULL COMMENT 'Название',
              PRIMARY KEY (`advantageId`, `languageId`) USING BTREE,
              CONSTRAINT `TypeAdvantageI18n_typeId` FOREIGN KEY (`advantageId`) REFERENCES `TypeAdvantage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `TypeAdvantageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160729_090808_PoolTypes cannot be reverted.\n";

        return false;
    }
}
