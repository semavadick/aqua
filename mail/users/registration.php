<?php

use yii\helpers\Html;

/**
 * Письмо о регистации на сайте
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var string $fullName
 * @var string $email
 * @var string $password
 */

$message->setSubject('Регистрация на сайте ' . Yii::$app->name);
?>

<p>
    Спасибо за регистрацию на сайте <?= Yii::$app->name ?>! Данные для входа на сайт:

    <br>
    <b>E-mail:</b> <?= Html::encode($email) ?>

    <br>
    <b>Пароль:</b> <?= Html::encode($password) ?>
</p>