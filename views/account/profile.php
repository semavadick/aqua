<?php
/**
 * Профиль пользователя
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\components\WebUser $wUser
 * @var \app\models\User $user
 * @var \app\forms\ProfileForm $formModel
 * @var \app\models\Order[] $orders
 */

\app\assets\Profile::register($this);

$title = Yii::t('app', 'My profile');
$this->setTitle($title);
$this->setMetaKeywords($title);
$this->setMetaDescription($title);
?>

<div class="personal-cabinet">
    <div class="center">
        <div class="two-columns">

            <div class="profile">

                <header class="main-head">
                    <h4><?= Yii::t('app', 'YOUR PROFILE') ?></h4>
                </header>

                <?= $this->render('profile/_discount', ['user' => $user]) ?>

                <?= $this->render('profile/_form', [
                    'user' => $user,
                    'formModel' => $formModel,
                ]) ?>

            </div>

            <?= $this->render('profile/_orders', [
                'language' => $language,
                'user' => $user,
                'orders' => $orders,
            ]) ?>

        </div>
    </div>
</div>