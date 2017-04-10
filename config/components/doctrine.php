<?php
/**
 * Конфиг для компонента Doctrine
 */

$local = require(__DIR__ . '/../local.php');
$local = $local['params']['db'];
return [
    'class' => 'app\components\Doctrine',
    'host' => $local['host'],
    'dbname' => $local['dbname'],
    'username' => $local['username'],
    'password' => $local['password'],
    'charset' => 'utf8',
];