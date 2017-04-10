<?php

use yii\helpers\Html;

/**
 * Письмо о новом вопросе
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var string $fullName
 * @var string $email
 * @var string $phone
 * @var string $question
 */

$message->setSubject('На сайте ' . Yii::$app->name . ' отправлен новый вопрос');
?>

<p>
    На сайте <?= Yii::$app->name ?> отправлен новый вопрос

    <br>
    <b>Имя и фамилия:</b> <?= Html::encode($fullName) ?>

    <br>
    <b>E-mail:</b> <?= Html::encode($email) ?>

    <br>
    <b>Телефон:</b> <?= Html::encode($phone) ?>

    <br>
    <b>Вопрос:</b> <?= Html::encode($question) ?>
</p>