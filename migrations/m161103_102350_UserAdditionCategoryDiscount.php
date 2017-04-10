<?php

use yii\db\Migration;

class m161103_102350_UserAdditionCategoryDiscount extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `UserAdditionCategoryDiscount` (
              `userId` BIGINT(19) UNSIGNED NOT NULL,
              `categoryId` SMALLINT(5) UNSIGNED NOT NULL,
              `discount` DECIMAL(5,2) DEFAULT NULL,
              PRIMARY KEY (`userId`, `categoryId`) USING BTREE,
              CONSTRAINT `UserAdditionCategoryDiscount_userId` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `UserAdditionCategoryDiscount_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `AdditionCategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m161103_102350_UserAdditionCategoryDiscount cannot be reverted.\n";

        return false;
    }
}
