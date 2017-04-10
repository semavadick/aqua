<?php
/**
 * Конфиг для локального окружения
 */

return [
    'params' => [

        // Указать ключ для валидации куки пользователя
        'cookieValidationKey' => 'moKlW70dElxd6qNI9gEZfTE0rhwnIEWO',

        // Секретный ключ для логина посетителя по кукам
        'autoLoginSecretKey' => 'VBADd5fS',

        // Настройки БД
        'db' => [
            'host' => 'localhost',
            'dbname' => 'aquasector',
            'username' => 'aquasector',
            'password' => 'q1w2e3',
        ],
        'mailer' => [
            'support' => [
                'email' => 'test@email.test',
                'name' => 'Robot'
            ]
        ],

        'recaptcha' => [
            'sitekey' => '6LeZShsUAAAAAH533hpkk2QwZoEZ0z6AWOanShkX',
            'secret' => '6LeZShsUAAAAANlu6-mIccTYOIev5DCl-GYr4Ynm'
        ]
    ],
];