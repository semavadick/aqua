<?php
/**
 * Конифг для компонента i18n
 */

return [
    'translations' => [
        'app*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@app/messages",
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                'app' => 'app.php',
            ],
        ],
        'back*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@back/messages",
            'sourceLanguage' => 'en-US',
            'fileMap' => [
                'back' => 'back.php',
            ],
        ],
    ],
];