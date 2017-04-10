<?php

use yii\db\Migration;

class m160809_210614_ClientsDiscount extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            ALTER TABLE `User` ADD COLUMN `discount` DECIMAL(5,2) DEFAULT NULL COMMENT 'Общая скидка';

            ALTER TABLE `Category` ADD COLUMN `hasDiscount` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Разрешена особая скидка';

            CREATE TABLE IF NOT EXISTS `UserCategoryDiscount` (
              `userId` BIGINT(19) UNSIGNED NOT NULL,
              `categoryId` SMALLINT(5) UNSIGNED NOT NULL,
              `discount` DECIMAL(5,2) DEFAULT NULL,
              PRIMARY KEY (`userId`, `categoryId`) USING BTREE,
              CONSTRAINT `UserCategoryDiscount_userId` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `UserCategoryDiscount_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }
}
