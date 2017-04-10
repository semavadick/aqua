<?php
/**
 * @var app\components\View $this
 * @var \app\models\User $user
 * @var \app\forms\ProfileForm $formModel
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'profile-form',
    'method' => 'POST',
    'action' => Url::to(['account/save-profile']),
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'validateOnBlur' => true,
    'fieldConfig' => [
        'template' => "{input}\n{error}",
    ],
]);
?>

    <div class="form-success"><?= Yii::t('app', 'Data has been saved successfully.') ?></div>

    <ul class="list-user-info">
        <li>
            <?= $form->field($formModel, 'fullName')->textInput([
                'placeHolder' => $formModel->getAttributeLabel('fullName'),
            ]) ?>
        </li>

        <?php if($formModel->isCompany()): ?>
            <li>
                <?= $form->field($formModel, 'companyName')->textInput([
                    'placeHolder' => $formModel->getAttributeLabel('companyName'),
                ]) ?>
            </li>
        <?php endif; ?>

        <li>
            <?= $form->field($formModel, 'phone')->textInput([
                'placeHolder' => $formModel->getAttributeLabel('phone'),
            ]) ?>
        </li>

        <li>
            <?= $form->field($formModel, 'email')->textInput([
                'disabled' => true,
                'placeHolder' => $formModel->getAttributeLabel('email'),
            ]) ?>
        </li>
    </ul>

    <div class="btn-holder">
        <button type="submit" class="btn"><?= Yii::t('app', 'save') ?></button>
    </div>

<?php $form->end();?>