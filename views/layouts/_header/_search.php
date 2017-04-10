<?php
/**
 * @var app\components\View $this
 */

use yii\widgets\ActiveForm;

$model = $this->context->getSearchForm();
?>

<a class="search-btn" href="#">
    <i class="search-ico"></i>
</a>


<?php
$regModel = new \app\forms\RegistrationForm();
$form = ActiveForm::begin([
    'id' => 'search-form',
    'method' => 'POST',
    'action' => \app\controllers\SearchController::getIndexUrl(),
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'options' => [
        'class' => 'popup-form',
    ],
    'fieldConfig' => [
        'options' => [
            'class' => 'input-holder',
        ],
        'template' => "{input}",
    ],
]);
?>

<fieldset>
    <div class="input-holder">
        <?= $form->field($model, 'query')->textInput([
            'placeHolder' => $model->getAttributeLabel('query'),
        ]) ?>
    </div>
    <button type="submit"><?= Yii::t('app', 'search') ?></button>
    <a class="btn-close" href="#">close</a>
</fieldset>

<?php $form->end() ?>