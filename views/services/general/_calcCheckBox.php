<?php

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \yii\widgets\ActiveForm $form
 * @var \app\forms\CalcForm $model
 * @var string $attribute
 */

$formName = $model->formName();
$isRadio = !empty($isRadio) ? $isRadio : false;
?>

<ul>
    <li>
        <h3>
            <?= $model->getAttributeLabel($attribute) ?>:
        </h3>
    </li>

    <?php foreach($model->getCheckboxOptions($attribute) as $val => $label):
        $id = $attribute . $val;
        ?>

        <li>
            <input
                id="<?= $id ?>"
                name="<?=  $model->formName() . "[{$attribute}][]" ?>"
                value="<?= $val ?>"
                type="<?= $isRadio ? 'radio' : 'checkbox' ?>"
            />
            <label for="<?= $id ?>"><?= $label ?></label>
        </li>

    <?php endforeach;?>

</ul>
