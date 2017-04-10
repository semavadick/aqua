<?php

use app\models\Language;
use yii\db\Migration;

class m160728_082408_PoolsBuildingPage extends Migration
{
    public function up()
    {

        $db = $this->getDb();
        $cmd = $db->createCommand("
            CREATE TABLE IF NOT EXISTS `PoolsBuildingPage` (
              `id` TINYINT(1) UNSIGNED NOT NULL,
              `projectIconPath` VARCHAR(255) DEFAULT '' COMMENT 'Иконка блока Проектирование',
              `projectImagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение блока Проектирование',
              `designIconPath` VARCHAR(255) DEFAULT '' COMMENT 'Иконка блока Дизайн',
              `designImagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение блока Дизайн',
              `buildingIconPath` VARCHAR(255) DEFAULT '' COMMENT 'Иконка блока Строительство',
              `buildingImagePath` VARCHAR(255) DEFAULT '' COMMENT 'Изображение блока Строительство',
              PRIMARY KEY (`id`) USING BTREE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            CREATE TABLE IF NOT EXISTS `PoolsBuildingPageI18n` (
              `languageId` tinyint(2) unsigned NOT NULL COMMENT 'ID языка',

              `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Title',
              `metaKeywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Meta-keywords',
              `metaDescription` varchar(1022) NOT NULL DEFAULT '' COMMENT 'Meta-description',

              `projectTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Заголовок блока Проектирование',
              `projectText` text NOT NULL COMMENT 'Текст блока Проектирование',
              `projectPresentationPath` varchar(255) NOT NULL DEFAULT '' COMMENT 'Презентация (путь до файла) блока Проектирование',

              `designTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Заголовок блока Дизайн',
              `designText` text NOT NULL COMMENT 'Текст блока Дизайн',
              `designPresentationPath` varchar(255) NOT NULL DEFAULT '' COMMENT 'Презентация (путь до файла) блока Дизайн',

              `buildingTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Заголовок блока Строительство',
              `buildingText` text NOT NULL COMMENT 'Текст блока Строительство',
              `buildingPresentationPath` varchar(255) NOT NULL DEFAULT '' COMMENT 'Презентация (путь до файла) блока Строительство',

              PRIMARY KEY (`languageId`) USING BTREE,
              CONSTRAINT `PoolsBuildingPageI18n_languageId` FOREIGN KEY (`languageId`) REFERENCES `Language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            INSERT INTO `PoolsBuildingPage` (`id`) VALUES (0);
            INSERT INTO `PoolsBuildingPageI18n` (`languageId`, `title`, `projectText`, `designText`, `buildingText`) VALUES
             (:ruId, :ruTitle, '', '', ''), (:enId, :enTitle, '', '', '');
        ");
        $cmd->bindValues([
            ':ruId' => Language::ID_RU,
            ':ruTitle' => 'Строительство бассейнов',

            ':enId' => Language::ID_EN,
            ':enTitle' => 'Pools building',
        ]);
        $cmd->execute();
        return true;
    }

    public function down()
    {
        echo "m160728_082408_PoolsBuilding cannot be reverted.\n";

        return false;
    }
}
