<?php

use yii\widgets\ActiveForm;

/**
 * @var \app\components\View $this
 * @var \app\forms\SearchForm $model
 */

?>

<?php
$form = ActiveForm::begin([
    'id' => 'search-r-form',
    'method' => 'POST',
    'action' => \app\controllers\SearchController::getIndexUrl(),
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'options' => [
        'class' => 'search-form-form',
    ],
    'fieldConfig' => [
        'options' => [
            'class' => 'search-form__input__cont',
        ],
        'template' => "{input}",
    ],
]);
?>

<button class="search-form__btn" type="submit">
    <?= Yii::t('app', 'search') ?>
</button>

<?= $form->field($model, 'query')->textInput([
    'class' => 'search-form__input',
    'placeholder' => $model->getAttributeLabel('query'),
]) ?>

<?= $form->field($model, 'section')->hiddenInput() ?>

<?php $form->end() ?>