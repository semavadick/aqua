<?php

use yii\db\Migration;

class m160815_214836_ArticlesCategories extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `ArticleCategory` (
              `articleId` INT(9) UNSIGNED NOT NULL,
              `categoryId` SMALLINT(5) UNSIGNED NOT NULL,
              PRIMARY KEY (`articleId`, `categoryId`) USING BTREE,
              CONSTRAINT `ArticleCategory` FOREIGN KEY (`articleId`) REFERENCES `Article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `ArticleCategory_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `Category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
