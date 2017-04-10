<?php

use yii\db\Migration;

class m160728_161547_BuildingFaq extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `FaqItem` (
              `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `FaqItemI18n` (
              `itemId` SMALLINT(5) unsigned NOT NULL COMMENT 'ID элемента',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `question` VARCHAR(1022) NOT NULL DEFAULT '' COMMENT 'Вопрос',
              `answer` TEXT NOT NULL COMMENT 'Ответ',
              PRIMARY KEY (`itemId`, `languageId`) USING BTREE,
              CONSTRAINT `FaqItemI18n_itemId` FOREIGN KEY (`itemId`) REFERENCES `FaqItem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `FaqItemI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }
}
