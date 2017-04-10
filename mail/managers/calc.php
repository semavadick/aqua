<?php

use yii\helpers\Html;

/**
 * Письмо о новой заявке на расчет стоимости бассейна
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var \app\forms\CalcForm $form
 */

$message->setSubject('На сайте ' . Yii::$app->name . ' отправлена заявка на расчет стоимости бассейна');
?>

<p>
    На сайте <?= Yii::$app->name ?> отправлена заявка на расчет стоимости бассейна

    <br>
    <b>Имя и фамилия:</b> <?= Html::encode($form->fullName) ?>

    <br>
    <b>E-mail:</b> <?= Html::encode($form->email) ?>

    <br>
    <b>Телефон:</b> <?= Html::encode($form->phone) ?>

    <br>
    <b>Регион:</b> <?= Html::encode($form->region) ?>

    <br>
    <b>Длина:</b> <?= Html::encode($form->length) ?>

    <br>
    <b>Ширина:</b> <?= Html::encode($form->width) ?>

    <br>
    <b>Глубина:</b> <?= Html::encode($form->depth ? $form->depth : $form->variableDepth) ?>

    <?php
    $attrs = [
        'poolType', 'position', 'purpose',
        'waterHeating', 'attractions',
        'covering', 'ladder', 'lighting',
        'sportEquipment', 'waterDisinfection', 'additionalDisinfection',
    ];
    foreach($attrs as $attr): ?>

        <br>
        <b><?= $form->getAttributeLabel($attr) ?>:</b>
        <?= Html::encode($form->getOptionLabel($attr)) ?>

    <?php endforeach;  ?>

</p>