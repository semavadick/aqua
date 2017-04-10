<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * Модалка для запроса каталога
 * @var app\components\View $this
 */

$formModel = new \app\forms\HelpForm();
?>

<div class="modal-header">
    <?= Yii::t('app', 'Let us help you') ?>
</div>

<?php
$form = ActiveForm::begin([
    'id' => 'help-form',
    'method' => 'POST',
    'action' => Url::to(['store/send-help-request']),
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'validateOnBlur' => true,
    'options' => [
        'class' => 'modal-form',
    ],
    'fieldConfig' => [
        'options' => [
            'class' => 'modal-form__field',
        ],
        'template' => "{input}\n{error}",
        'inputOptions' => [
            'class' => 'modal-form__control',
        ],
        'errorOptions' => [
            'class' => 'modal-form__error',
        ],
    ],
]);
?>
<div class="modal-form__success">
    <?= Yii::t('app', 'Your request has been sent successfully') ?>
</div>

<?php
echo $form->field($formModel, 'fullName')->textInput([
    'placeHolder' => $formModel->getAttributeLabel('fullName'),
]);
echo $form->field($formModel, 'email')->textInput([
    'placeHolder' => $formModel->getAttributeLabel('email'),
]);
echo $form->field($formModel, 'phone')->textInput([
    'placeHolder' => $formModel->getAttributeLabel('phone'),
]);
?>

<div class="modal-form__btn__wrap">
    <button type="submit" class="modal-form__btn">
        <?= Yii::t('app', 'send') ?>
    </button>
</div>
<?php $form->end() ?>
