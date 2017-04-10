<?php

use yii\db\Migration;

class m160815_221722_UserFile extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            ALTER TABLE `User` ADD COLUMN `companyInfoFilePath` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Файл  информацией о компании';
            ");
        $cmd->execute();
        return true;

    }
}
