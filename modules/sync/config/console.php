<?php

Yii::setAlias('@sync', __DIR__ . '/../');
return [
    'modules' => [
        'sync' => [
            'class' => 'sync\Module',
            'controllerNamespace' => 'sync\cli',
            'defaultRoute' => 'sync/sync-all'
        ],
    ],
];