<?php

use yii\db\Migration;

class m160723_184422_AboutPageHistory extends Migration {

    public function up() {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `HistoryStage` (
              `id` TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
              `year` MEDIUMINT(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Год',
              `imagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `HistoryStageI18n` (
              `stageId` tinyint(2) unsigned NOT NULL COMMENT 'ID этапа',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `text` text NOT NULL COMMENT 'Текст',
              PRIMARY KEY (`stageId`, `languageId`) USING BTREE,
              CONSTRAINT `HistoryStageI18n_bannerId` FOREIGN KEY (`stageId`) REFERENCES `HistoryStage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `HistoryStageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
