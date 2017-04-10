<?php

use yii\db\Migration;

class m160809_100712_Clients extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            ALTER TABLE `User` ADD COLUMN `phone` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Телефон';
            ALTER TABLE `User` ADD COLUMN `type` TINYINT(2) NOT NULL DEFAULT '0' COMMENT 'Тип клиента';
            ALTER TABLE `User` ADD COLUMN `companyType` TINYINT(2) NOT NULL DEFAULT '0' COMMENT 'Форма компании';
            ALTER TABLE `User` ADD COLUMN `companyName` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'Название компании';
            ALTER TABLE `User` ADD COLUMN `companyINN` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'ИНН компании';
            ALTER TABLE `User` ADD COLUMN `companyKPP` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'КПП компании';
            ALTER TABLE `User` ADD COLUMN `companyBank` VARCHAR(1022) NOT NULL DEFAULT '' COMMENT 'Банк компании';
            ALTER TABLE `User` ADD COLUMN `companyСA` VARCHAR(1022) NOT NULL DEFAULT '' COMMENT 'Банк компании';
            ALTER TABLE `User` ADD COLUMN `companyCheckingAccount` VARCHAR(1022) NOT NULL DEFAULT '' COMMENT 'Расчетный счет компании';
            ALTER TABLE `User` ADD COLUMN `companyCreditAccount` VARCHAR(1022) NOT NULL DEFAULT '' COMMENT 'Кредитный счет компании';
            ALTER TABLE `User` ADD COLUMN `companyLegalAddress` VARCHAR(1022) NOT NULL DEFAULT '' COMMENT 'Юридический адрес компании';
            ALTER TABLE `User` ADD COLUMN `companyActualAddress` VARCHAR(1022) NOT NULL DEFAULT '' COMMENT 'Фактический адрес компании';
            ALTER TABLE `User` ADD COLUMN `companyCEO` VARCHAR(1022) NOT NULL DEFAULT '' COMMENT 'Генеральный диреткор компании';
            ");
        $cmd->execute();
        return true;

    }

    public function down()
    {
        echo "m160809_100712_Clients cannot be reverted.\n";

        return false;
    }

}
