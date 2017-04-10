<?php
use yii\helpers\Url;

/**
 * Страница входа в админку
 *
 * @var back\components\View $this
 * @var back\models\forms\Login $model
 */

$this->setTitle(Yii::t('back', 'Sign in to content management system'));

$form = \yii\widgets\ActiveForm::begin([
    'id' => 'login-form',
    'method' => 'POST',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'validateOnBlur' => true,
    'fieldConfig' => [
        'template' => '{input}{error}',
    ],
]);
$session = Yii::$app->getSession();
?>

    <?php if($session->hasFlash('incorrectPassword')): ?>
        <div class="alert alert-dismissable alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button>
                <span class="title">
                    <i class="icon-remove-sign"></i>
                    <?= $session->getFlash('incorrectPassword') ?>
                </span>
        </div>
    <?php endif; ?>

    <span class="login-text">
        <?= Yii::t('back', 'Sign in to content management system') ?>:
    </span>

    <?php
    echo $form
        ->field($model, 'email')
        ->textInput(['placeholder' => $model->getAttributeLabel('email')]);

    echo $form
        ->field($model, 'password')
        ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]);
    ?>

    <div class="panel-footer">
        <?= \yii\helpers\Html::button(Yii::t('back', 'SIGN IN'), [
            'type' => 'submit',
            'class' => 'btn btn-log btn-success',
        ]) ?>

        <a href="<?= Url::toRoute('admin/forgot-password') ?>" class="login-link">
            <?= Yii::t('back', 'Forgot your password?') ?>:
        </a>
    </div>

<?php $form->end(); ?>