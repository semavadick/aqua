<?php

use yii\helpers\Html;

/**
 * Письмо о запросе услуги Обслуживание бассейнов
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var string $fullName
 * @var string $email
 * @var string $phone
 */

$message->setSubject('На сайте ' . Yii::$app->name . ' отправлен запрос на услугу Обслуживание бассейнов');
?>

<p>
    На сайте <?= Yii::$app->name ?> отправлен запрос на услугу Обслуживание бассейнов

    <br>
    <b>Имя и фамилия:</b> <?= Html::encode($fullName) ?>

    <br>
    <b>E-mail:</b> <?= Html::encode($email) ?>

    <br>
    <b>Телефон:</b> <?= Html::encode($phone) ?>
</p>