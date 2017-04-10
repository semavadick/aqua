<?php

use yii\helpers\BaseArrayHelper;

Yii::setAlias('@webroot', __DIR__ . '/../web');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/components/db.php'),
        'doctrine' => require(__DIR__ . '/components/doctrine.php'),
        'mailer' => require(__DIR__ . '/components/mailer.php'),
        'authManager' => require(__DIR__ . '/components/authManager.php'),
    ],
];

$backModuleConfig = require(__DIR__ . '/../modules/back/config/console.php');
$syncModuleConfig = require(__DIR__ . '/../modules/sync/config/console.php');
return yii\helpers\BaseArrayHelper::merge($config, $backModuleConfig, $syncModuleConfig);