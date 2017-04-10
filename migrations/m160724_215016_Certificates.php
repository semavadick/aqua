<?php

use yii\db\Migration;

class m160724_215016_Certificates extends Migration
{
    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `Certificate` (
              `id` TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `previewPath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение',
              `imagepath` VARCHAR(255) DEFAULT '' COMMENT 'Превью',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `CertificateI18n` (
              `certificateId` tinyint(2) unsigned NOT NULL COMMENT 'ID сертификата',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название',
              PRIMARY KEY (`certificateId`, `languageId`) USING BTREE,
              CONSTRAINT `CertificateI18n_advantageId` FOREIGN KEY (`certificateId`) REFERENCES `Certificate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `CertificateI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
