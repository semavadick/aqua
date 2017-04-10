<?php

use yii\db\Migration;

class m160815_233406_Product3DModel extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            ALTER TABLE `Product` ADD COLUMN `figure` TEXT NOT NULL COMMENT 'Код 3-d модели';
            ALTER TABLE `Product` DROP COLUMN `figurePath`;
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160815_233406_Product3DModel cannot be reverted.\n";

        return false;
    }
}
