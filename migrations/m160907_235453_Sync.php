<?php

use yii\db\Migration;

class m160907_235453_Sync extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            ALTER TABLE `Category` ADD COLUMN `importId` VARCHAR(255) DEFAULT '';
            ALTER TABLE `Product` ADD COLUMN `importId` VARCHAR(255) DEFAULT '';
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160907_235453_Sync cannot be reverted.\n";

        return false;
    }
}
