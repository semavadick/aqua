<?php

use yii\db\Migration;

class m160815_193946_MainPageCatalogAndVideo extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            ALTER TABLE `MainPageI18n` ADD COLUMN `catalogFilePath` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Путь до файла каталога';
            ALTER TABLE `MainPageI18n` ADD COLUMN `catalogImagePath` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Путь до изображения каталога';
            ALTER TABLE `MainPageI18n` ADD COLUMN `aboutVideo` TEXT NOT NULL COMMENT 'Видео блока О компании';
            ");
        $cmd->execute();
        return true;

    }

    public function down()
    {
        echo "m160815_193946_MainPageCatalogAndVideo cannot be reverted.\n";

        return false;
    }
}
