<?php

use yii\db\Migration;

class m161025_132425_AdditionProductsAddKupelType extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("ALTER TABLE `AdditionProduct` ADD `kupelType` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Тип купели' after `isOnOffer`");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m161025_132425_AdditionProductsAddKupelType cannot be reverted.\n";

        return false;
    }
}
