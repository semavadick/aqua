<?php
/**
 * Файл с реквтзитами компании
 * в форме регистрации
 *
 * @var \app\components\View $this
 * @var \yii\widgets\ActiveForm $form
 * @var \app\forms\Form $model
 * @var string $attribute
 */

\app\assets\UFile::register($this);

$label = Yii::t('app', 'upload your company information to fast bill generation:');
$label = "<span class='u-file__label'>{$label}</span>";

$btnLabel = Yii::t('app', 'choose a file');
$btn = "<button type='button' class='u-file__btn'>{$btnLabel}</button>";
$btn = "<div class='u-file__btn__wrap'>{$btn}</div>";

echo $form->field($model, $attribute, [
    'template' => $btn . $label . '{input}' . '{error}',
    'options' => [
        'class' => 'modal-form__field u-file',
    ],
])->fileInput([
    'name' => $attribute,
    'class' => '.u-file__input',
]);
