<?php

use yii\db\Migration;

class m160718_153027_Languages extends Migration {

    private $table = 'Language';

    public function up() {
        $table = $this->table;
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `{$table}` (
              `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
              `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Название',
              `slug` varchar(255) NOT NULL DEFAULT '' COMMENT 'ЧПУ',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
        $cmd->execute();

        $ruLang = new \app\models\Language();
        $ruLang->setName('Русский');
        $ruLang->setSlug('ru');
        \app\repositories\LanguagesRepository::getInstance()->saveLanguage($ruLang);

        $enLang = new \app\models\Language();
        $enLang->setName('Английский');
        $enLang->setSlug('en');
        \app\repositories\LanguagesRepository::getInstance()->saveLanguage($enLang);

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
