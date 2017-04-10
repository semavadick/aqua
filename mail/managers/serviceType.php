<?php

use yii\helpers\Html;

/**
 * Письмо о запросе расчета Эксклюзивного изделия
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var string $fullName
 * @var string $email
 * @var string $phone
 */

$message->setSubject('На сайте ' . Yii::$app->name . ' отправлен запрос расчета экзклюзивного изделия');
?>

<p>
    На сайте <?= Yii::$app->name ?> отправлен запрос расчета экзклюзивного изделия

    <br>
    <b>Имя и фамилия:</b> <?= Html::encode($fullName) ?>

    <br>
    <b>E-mail:</b> <?= Html::encode($email) ?>

    <br>
    <b>Телефон:</b> <?= Html::encode($phone) ?>

    <br>
    <b>Название изделия:</b> <?= Html::encode($typeTitle) ?>
</p>