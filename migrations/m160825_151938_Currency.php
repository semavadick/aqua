<?php

use yii\db\Migration;

class m160825_151938_Currency extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `Currency` (
              `id` tinyint(3) UNSIGNED NOT NULL,
              `rate` decimal(8,4) NOT NULL DEFAULT '0.0' COMMENT 'Ratio (относительно дефолтной валюты)',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `Currency` (`id`, `rate`) VALUES (1, 1), (2, 0.0154);

            ALTER TABLE `Order` ADD COLUMN `currencyId` TINYINT(3) UNSIGNED DEFAULT NULL;
            UPDATE `Order` SET  `currencyId`=1;
            ALTER TABLE `Order` ADD CONSTRAINT `Order_currencyId` FOREIGN KEY (`currencyId`) REFERENCES `Currency` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160815_214836_ArticlesCategories cannot be reverted.\n";

        return false;
    }
}
