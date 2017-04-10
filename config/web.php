<?php

use yii\helpers\BaseArrayHelper;

$config = [
    'id' => 'basic',
    'language' => 'ru',
    'name' => 'Aquasector',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => require(__DIR__ . '/components/request.php'),
        'db' => require(__DIR__ . '/components/db.php'),
        'doctrine' => require(__DIR__ . '/components/doctrine.php'),
        'i18n' => require(__DIR__ . '/components/i18n.php'),
        'mailer' => require(__DIR__ . '/components/mailer.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => require(__DIR__ . '/components/user.php'),
        'authManager' => require(__DIR__ . '/components/authManager.php'),
        'errorHandler' => require(__DIR__ . '/components/errorHandler.php'),
        'urlManager' => require(__DIR__ . '/components/urlManager.php'),
        'bitrixLeadsManager' => require(__DIR__ . '/components/bitrixLeadsManager.php'),
    ],
];

$backModuleConfig = require(__DIR__ . '/../modules/back/config/web.php');
$localConfig = require(__DIR__ . '/local.php');
return BaseArrayHelper::merge($config, $backModuleConfig, $localConfig);