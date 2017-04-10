<?php

use yii\helpers\Html;

/**
 * Письмо о запросе Реставрирование бассейнов
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var string $fullName
 * @var string $email
 * @var string $phone
 */

$message->setSubject('На сайте ' . Yii::$app->name . ' отправлен запрос на расчет Реставрации бассейнов');
?>

<p>
    На сайте <?= Yii::$app->name ?> отправлен запрос на расчет Реставрации бассейнов

    <br>
    <b>Имя и фамилия:</b> <?= Html::encode($fullName) ?>

    <br>
    <b>E-mail:</b> <?= Html::encode($email) ?>

    <br>
    <b>Телефон:</b> <?= Html::encode($phone) ?>
</p>