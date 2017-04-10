<?php

use yii\db\Migration;

class m160814_154202_Settings extends Migration
{
    public function up()
    {
        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `Setting` (
              `id` TINYINT(1) UNSIGNED NOT NULL,
              `phone1` VARCHAR(255) DEFAULT '' COMMENT 'Телефон 1',
              `phone2` VARCHAR(255) DEFAULT '' COMMENT 'Телефон 1',
              `colnsultEmail` VARCHAR(255) DEFAULT '' COMMENT 'E-mail для запроса консультации',
              `calcEmail` VARCHAR(255) DEFAULT '' COMMENT 'E-mail для запроса рассчета',
              `feedbackEmail` VARCHAR(255) DEFAULT '' COMMENT 'E-mail для запроса обратной связи',
              `facebookLink` VARCHAR(1022) DEFAULT '' COMMENT 'Ссылка на facebook',
              `twitterLink` VARCHAR(1022) DEFAULT '' COMMENT 'Ссылка на twitter',
              `youtubeLink` VARCHAR(1022) DEFAULT '' COMMENT 'Ссылка на youtube',
              `countersCode` TEXT COMMENT 'Код счетчиков',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `Setting` VALUES
              (0, :phone1, :phone2, :colnsultEmail, :calcEmail, :feedbackEmail, :facebookLink, :twitterLink, :youtubeLink, :countersCode);
        ");
        $cmd->bindValues([
            ':phone1' => '+7 (495) 902-58-06',
            ':phone2' => '+7 (495) 902-58-07',
            ':colnsultEmail' => 'consult@aquasector.com',
            ':calcEmail' => 'calc@aquasector.com',
            ':feedbackEmail' => 'feedback@aquasector.com',
            ':facebookLink' => 'http://facebook.com/',
            ':twitterLink' => 'http://twitter.com/',
            ':youtubeLink' => 'http://youtube.com/',
            ':countersCode' => '',
        ]);
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160814_154202_Settings cannot be reverted.\n";

        return false;
    }

}
