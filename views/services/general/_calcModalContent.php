<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 */

$model = new \app\forms\CalcForm();
?>

<div class="modal-header">
    <?= Yii::t('app', 'Application for pool cost calculation') ?>
</div>

<?php
$form = ActiveForm::begin([
    'id' => 'discount-form',
    'method' => 'POST',
    'action' => Url::to(['services/send-calc-request']),
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

<div class="popup-holder">

    <div class="box">
        <ul class="list">

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'poolType',
                    'isRadio' => true,
                ]) ?>
            </li>

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'position',
                    'isRadio' => true,
                ]) ?>
            </li>

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'purpose',
                    'isRadio' => true,
                ]) ?>
            </li>

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'waterHeating',
                    'isRadio' => true,
                ]) ?>
            </li>

        </ul>
    </div>

    <div class="box2">
        <ul class="list">

            <li>
                <h3><?= Yii::t('app', 'Pool dimensions:') ?></h3>
            </li>

            <li>
                <label for="calc-length"><?= Yii::t('app', 'Length, m:') ?></label>
                <input
                    id="calc-length"
                    type="text"
                    name="<?= $model->formName() . "[length]" ?>"
                    placeholder="10">
            </li>

            <li>
                <label for="calc-width"><?= Yii::t('app', 'Width, m:') ?></label>
                <input
                    id="calc-width"
                    type="text"
                    name="<?= $model->formName() . "[width]" ?>"
                    placeholder="4">
            </li>

            <li>
                <div class="row">
                    <label for="calc-depth"><?= Yii::t('app', 'Depth, m:') ?></label>
                    <input
                        id="calc-depth"
                        type="text"
                        name="<?= $model->formName() . "[depth]" ?>"
                        placeholder="2">
                </div>

                <div class="row">
                    <label for="calc-variable-depth"><?= Yii::t('app', 'or variable:') ?></label>
                    <input
                        id="calc-variable-depth"
                        type="text"
                        name="<?= $model->formName() . "[variableDepth]" ?>"
                        style="width: 51px;"
                        placeholder="1.5-3">
                </div>
            </li>

        </ul>
    </div>

    <div class="box3">
        <h3><?= Yii::t('app', 'Pool equipment:') ?></h3>

        <ul class="list">

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'attractions',
                ]) ?>

                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'covering',
                    'isRadio' => true,
                ]) ?>
            </li>

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'ladder',
                    'isRadio' => true,
                ]) ?>

                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'lighting',
                    'isRadio' => true,
                ]) ?>
            </li>

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'sportEquipment',
                ]) ?>
            </li>

        </ul>
    </div>

    <div class="box4">
        <ul class="list">

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'waterDisinfection',
                    'isRadio' => true,
                ]) ?>
            </li>

            <li>
                <?= $this->render('_calcCheckBox', [
                    'form' => $form,
                    'model' => $model,
                    'attribute' => 'additionalDisinfection',
                ]) ?>
            </li>

        </ul>
    </div>

    <?php
    echo $form->field($model, 'fullName')->textInput([
        'placeHolder' => $model->getAttributeLabel('fullName'),
    ]);
    echo $form->field($model, 'email')->textInput([
        'placeHolder' => $model->getAttributeLabel('email'),
    ]);
    echo $form->field($model, 'phone')->textInput([
        'placeHolder' => $model->getAttributeLabel('phone'),
    ]);
    echo $form->field($model, 'region')->textInput([
        'placeHolder' => $model->getAttributeLabel('region'),
    ]);

    echo $form->field($model, 'captcha')->widget(
        \app\widgets\Recaptcha::className(), [
        'options' => [
            'id' => 'calcCaptcha'
        ]
    ]);
    ?>

</div>

<div class="modal-form__btn__wrap">
    <button type="submit" class="modal-form__btn">
        <?= Yii::t('app', 'send the application') ?>
    </button>
</div>
<?php $form->end() ?>

