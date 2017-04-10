<?php
/**
 * Конфиг для компонента
 */

$local = require(__DIR__ . '/../local.php');
return [
    // Указать ключ для валидации куки пользователя
    'cookieValidationKey' => $local['params']['cookieValidationKey'],
];