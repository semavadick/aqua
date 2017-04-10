<?php

use yii\helpers\Html;

/**
 * Письмо о новом запросе информации о скидке
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var string $fullName
 * @var string $email
 * @var string $phone
 */

$message->setSubject('На сайте ' . Yii::$app->name . ' отправлен новый запрос информации о скидке');
?>

<p>
    На сайте <?= Yii::$app->name ?> отправлен новый запрос информации о скидке

    <br>
    <b>Имя и фамилия:</b> <?= Html::encode($fullName) ?>

    <br>
    <b>E-mail:</b> <?= Html::encode($email) ?>

    <br>
    <b>Телефон:</b> <?= Html::encode($phone) ?>
</p>