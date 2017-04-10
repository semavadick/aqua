<?php

use yii\db\Migration;

class m160718_202328_MainPageBanners extends Migration  {

    private $table = 'MainPageBanner';

    public function up() {
        $table = $this->table;
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `{$table}` (
              `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `pageId` tinyint(2) unsigned NOT NULL COMMENT 'ID страницы',
              `sort` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT 'Сортировка',
              `text` text NOT NULL COMMENT 'Текст',
              `link` text NOT NULL COMMENT 'Ссылка',
              `imagePath` varchar(255) NOT NULL DEFAULT '' COMMENT 'Путь до изображения',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `{$table}_pageId` FOREIGN KEY (`pageId`) REFERENCES `MainPage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
        $cmd->execute();
        return true;
    }

    public function down() {
        $table = $this->table;
        $db = $this->getDb();
        $cmd = $db->createCommand("
            DROP TABLE `{$table}`;
        ");
        $cmd->execute();
        return true;
    }

}
