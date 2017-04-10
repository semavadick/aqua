<?php

use yii\db\Migration;

class m160724_170242_Advantages extends Migration
{
    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `Advantage` (
              `id` TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `iconPath` VARCHAR(255) DEFAULT '' COMMENT 'Иконка',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `AdvantageI18n` (
              `advantageId` tinyint(2) unsigned NOT NULL COMMENT 'ID преимущества',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` text NOT NULL COMMENT 'Текст',
              PRIMARY KEY (`advantageId`, `languageId`) USING BTREE,
              CONSTRAINT `AdvantageI18n_advantageId` FOREIGN KEY (`advantageId`) REFERENCES `Advantage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `AdvantageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
