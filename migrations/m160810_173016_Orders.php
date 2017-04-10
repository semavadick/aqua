<?php

use yii\db\Migration;

class m160810_173016_Orders extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("

            CREATE TABLE IF NOT EXISTS `Order` (
              `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
              `userId` bigint(19) unsigned DEFAULT NULL COMMENT 'ID пользователя',
              `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата добавления',
              `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Статус',
              `discount` decimal(5,2) DEFAULT NULL COMMENT 'Общая скидка',
              PRIMARY KEY (`id`),
              CONSTRAINT `Order_userId` FOREIGN KEY (`userID`) REFERENCES `User` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE `OrderProduct` (
              `id` bigint(19) unsigned NOT NULL AUTO_INCREMENT,
              `orderId` bigint(19) unsigned NOT NULL COMMENT 'ID заказа',
              `productId` int(9) unsigned DEFAULT NULL COMMENT 'ID товара',
              `sku` varchar(255) NOT NULL DEFAULT '' COMMENT 'SKU товара',
              `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Название товара',
              `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'Цена товара',
              `quantity` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Кол-во',
              `discount` decimal(5,2) DEFAULT NULL COMMENT 'Скидка',
              PRIMARY KEY (`id`),
              CONSTRAINT `OrderProduct_orderId` FOREIGN KEY (`orderId`) REFERENCES `Order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `OrderProduct_productId` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160810_173016_Orders cannot be reverted.\n";

        return false;
    }
}
