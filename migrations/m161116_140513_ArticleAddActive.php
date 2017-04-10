<?php

use yii\db\Migration;

class m161116_140513_ArticleAddActive extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("ALTER TABLE `Article` ADD `active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Опубликован' after `added`");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m161116_140513_ArticleAddActive cannot be reverted.\n";

        return false;
    }
}
