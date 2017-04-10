<?php

use yii\db\Migration;

class m161028_093302_ServiceType extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `ServiceType` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `serviceId` SMALLINT(5) UNSIGNED NOT NULL,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `imagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `ServiceType_serviceId` FOREIGN KEY (`serviceId`) REFERENCES `Service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `ServiceTypeI18n` (
              `typeId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID типа',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` TEXT NOT NULL COMMENT 'Текст',
              PRIMARY KEY (`typeId`, `languageId`) USING BTREE,
              CONSTRAINT `ServiceTypeI18n_serviceId` FOREIGN KEY (`typeId`) REFERENCES `ServiceType` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ServiceTypeI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m161028_093302_ServiceType cannot be reverted.\n";

        return false;
    }
}
