<?php

use yii\db\Migration;

class m160728_154432_TechAdvantages extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `TechAdvantage` (
              `id` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
              `sort` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
              `iconPath` VARCHAR(255) DEFAULT '' COMMENT 'Иконка',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `TechAdvantageI18n` (
              `advantageId` tinyint(3) unsigned NOT NULL COMMENT 'ID преимущества',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `tagline` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Слоган',
              `text` TEXT NOT NULL COMMENT 'Текст',
              PRIMARY KEY (`advantageId`, `languageId`) USING BTREE,
              CONSTRAINT `TechAdvantageI18n_advantageId` FOREIGN KEY (`advantageId`) REFERENCES `TechAdvantage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `TechAdvantageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160728_154432_TechAdvantages cannot be reverted.\n";

        return false;
    }

}
