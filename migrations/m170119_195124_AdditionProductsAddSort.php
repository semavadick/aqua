<?php

use yii\db\Migration;

class m170119_195124_AdditionProductsAddSort extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("ALTER TABLE `AdditionProduct` ADD `sort` SMALLINT(5) UNSIGNED DEFAULT '0' COMMENT 'Сортировка' after `certificatePath`");
        $cmd->execute();
        $cmd = $db->createCommand("SELECT `id`, `categoryId` FROM `AdditionProduct`");
        $result = $cmd->queryAll();
        $products = [];
        foreach($result as $product) {
            $products[$product['categoryId']][] = $product;
        }
        foreach($products as $productCategory) {
            $sort = 1;
            foreach($productCategory as $product) {
                $updateCommand = $db->createCommand("UPDATE `AdditionProduct` SET `sort` = ".$sort." WHERE id = ".$product['id']);
                $updateCommand->execute();
                $sort++;
            }
        }
        return true;
    }

    public function down()
    {
        echo "m170119_195124_AdditionProductsAddSort cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
