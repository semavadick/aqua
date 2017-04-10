<?php

use yii\db\Migration;
use app\models\Language;

class m160718_161015_MainPage extends Migration {

    private $table = 'MainPage';

    public function up() {
        $table = $this->table;
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS  `{$table}` (
              `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',
              `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Title',
              `metaKeywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Meta-keywords',
              `metaDescription` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Meta-description',
              `aboutTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Заголовок О компании',
              `aboutText` text NOT NULL COMMENT 'Текст О компании',
              `aboutVideoCode` text NOT NULL COMMENT 'Код видео О компании',
              PRIMARY KEY (`id`) USING BTREE,
              CONSTRAINT `{$table}_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `{$table}` (`languageId`, `aboutText`, `aboutVideoCode`, `title`) VALUES (:ruId, '', '', :ruTitle), (:enId, '', '', :enTitle);
        ");
        $cmd->bindValues([
            ':ruId' => Language::ID_RU,
            ':ruTitle' => 'Главная страница',

            ':enId' => Language::ID_EN,
            ':enTitle' => 'Main page',
        ]);
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
