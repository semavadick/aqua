<?php

use yii\helpers\Html;

/**
 * Страница ошибки
 * @var app\components\View $this
 * @var string $message
 */

$title = 'Ошибка';
$this->setTitle($title);
$this->setMetaKeywords($title);
$this->setMetaDescription($title);
?>

<h1><?= Html::encode($message) ?></h1>