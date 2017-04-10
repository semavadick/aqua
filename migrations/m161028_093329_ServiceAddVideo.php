<?php

use yii\db\Migration;

class m161028_093329_ServiceAddVideo extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("ALTER TABLE `ServiceI18n` ADD `video` TEXT NOT NULL DEFAULT '' COMMENT 'Видео' after `additDescription`");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m161028_093329_ServiceAddVideo cannot be reverted.\n";

        return false;
    }
}
