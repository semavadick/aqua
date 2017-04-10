<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

/**
 * Контент модального окна
 * для отправления заявки
 *
 * @var app\components\View $this
 */
?>

<div id="popup-reg" style="width: 1200px; max-width: 100%; border: 1px #00aeef solid;">
    <div class="popup-info">

        <div class="cab">
            <header class="head">
                <h2><?= Yii::t('app', 'Login') ?></h2>
            </header>
            <?php
            $loginModel = new \app\forms\LoginForm();
            $loginForm = ActiveForm::begin([
                'id' => 'login-form',
                'method' => 'POST',
                'action' => Url::to(['account/login']),
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

            <?php
            echo $loginForm->field($loginModel, 'email')->textInput([
                'placeHolder' => $loginModel->getAttributeLabel('email'),
            ]);
            echo $loginForm->field($loginModel, 'password')->passwordInput([
                'placeHolder' => $loginModel->getAttributeLabel('password'),
            ]);
            ?>

            <div class="holder">
                <div class="check-holder">
                    <?php $checkId = $loginModel->formName() . '_remember'; ?>
                    <input
                        type="checkbox"
                        id="<?= $checkId ?>"
                        value="1"
                        name="<?= $loginModel->formName() . '[remember]'?>"
                    >
                    <label for="<?= $checkId ?>"><?= Yii::t('app', 'remember me') ?></label>
                </div>
                <a class="forget-btn" href="#"><?= Yii::t('app', 'forgot your password?') ?></a>
            </div>


            <div class="modal-form__btn__wrap">
                <button type="submit" class="modal-form__btn">
                    <?= Yii::t('app', 'sign in') ?>
                </button>
            </div>
            <?php $loginForm->end() ?>
        </div>

        <div class="reg">
            <header class="head">
                <h2><?= Yii::t('app', 'Registration') ?></h2>
            </header>
            <?php
            $regModel = new \app\forms\RegistrationForm();
            $regForm = ActiveForm::begin([
                'id' => 'registration-form',
                'method' => 'POST',
                'action' => Url::to(['account/register']),
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
                <?= Yii::t('app', 'Registration is successful. Authentication information has been sent on your email.') ?>
            </div>

            <?php
            echo $regForm->field($regModel, 'fullName')->textInput([
                'placeHolder' => $regModel->getAttributeLabel('fullName'),
            ]);
            echo $regForm->field($regModel, 'email')->textInput([
                'placeHolder' => $regModel->getAttributeLabel('email'),
            ]);
            echo $regForm->field($regModel, 'phone')->textInput([
                'placeHolder' => $regModel->getAttributeLabel('phone'),
            ]);
            echo $this->render('/general/_regFormFile', [
                'form' => $regForm,
                'model' => $regModel,
                'attribute' => 'uFile',
            ]);
            ?>

            <div class="modal-form__btn__wrap">
                <button type="submit" class="modal-form__btn">
                    <?= Yii::t('app', 'sign up') ?>
                </button>
            </div>
            <?php $regForm->end() ?>
        </div>

    </div>
</div>

