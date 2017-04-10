<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * Контент модального окна
 * для отправки заказа услуги
 *
 * @var app\components\View $this
 * @var app\forms\ServiceTypeForm $formModel
 */

$formModel = new \app\forms\ServiceTypeForm();
?>

<div class="modal-header">
    <?= Yii::t('app', 'Request the service type') ?>
</div>

<?php
$form = ActiveForm::begin([
    'id' => 'exclusive-type-form',
    'method' => 'POST',
    'action' => Url::to(['services/request-exclusive-type']),
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'validateOnBlur' => true,
    'options' => [
        'class' => 'modal-form',
        'enctype' => 'multipart/form-data'
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

echo $this->render('_formFile', [
    'form' => $form,
    'attribute' => 'uFile',
    'model' => $formModel
]);

echo $form->field($formModel, 'typeTitle')->hiddenInput([
    'class' => 'type-title-hidden'
]);

echo $form->field($formModel, 'captcha')->widget(
    \app\widgets\Recaptcha::className(), [
    'options' => [
        'id' => 'exclusiveCaptcha'
    ]
]);
?>

<div class="modal-form__btn__wrap">
    <button type="submit" class="modal-form__btn">
        <?= Yii::t('app', 'send') ?>
    </button>
</div>
<?php $form->end() ?>
