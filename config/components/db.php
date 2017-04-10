<?php
/**
 * Конфиг для компонента БД
 */

$local = require(__DIR__ . '/../local.php');
$local = $local['params']['db'];
return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$local['host']};dbname={$local['dbname']}",
    'username' => $local['username'],
    'password' => $local['password'],
    'charset' => 'utf8',
    'tablePrefix' => '',
];