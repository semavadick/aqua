<?php

Yii::setAlias('@back', __DIR__ . '/../');
return [
    'modules' => [
        'back' => [
            'class' => 'back\Module',
            'controllerNamespace' => 'back\console\controllers',
            'components' => [
                'mailer' => require(__DIR__ . '/components/mailer.php'),
            ],
        ],
    ],
];