<?php

use yii\helpers\Html;
use app\controllers\AddressesController;

/**
 * Info holder
 *
 * @var app\components\View $this
 * @var \app\models\Setting $setting
 */

$isMobile = !empty($isMobile) ? $isMobile : false;

$phone1 = Html::encode($setting->getPhone1());
$phone2 = Html::encode($setting->getPhone2());
?>

<div class="info-holder">

    <div class="tel-holder">
        <a href="tel:<?= $phone1 ?>" class="tel"><?= $phone1 ?>,</a>
        <a href="tel:<?= $phone2 ?>" class="tel"><?= $phone2 ?></a>
        <a href="<?= AddressesController::getIndexUrl() ?>" class="address-link"><?= Yii::t('app', 'addresses on the map') ?></a>
    </div>

    <?php if($isMobile): ?>
        <a class="btn send-application" href="#"><?= Yii::t('app', 'send an application') ?></a>
    <?php endif; ?>

</div>