<?php
/**
 * @var app\components\View $this
 * @var \app\models\User $user
 */

if(!$user->hasDiscount()) {
    return;
}
?>

<div class="discount">
    <span class="text"><?= Yii::t('app', 'general discount:') ?></span>
    <span class="persent"><?= round($user->getDiscount()) ?><sub>%</sub></span>
    <span class="descr"><?= Yii::t('app', 'в интернет магазине ваши цены уже отображены со скидкой.') ?></span>
</div>


