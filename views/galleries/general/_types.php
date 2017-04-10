<?php

use yii\helpers\Html;
use app\controllers\GalleriesController;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PoolType|null $activeType
 * @var \app\models\PoolType[] $types
 * @var bool $isManufacturing
 */

$isManufacturing = !empty($isManufacturing) ? $isManufacturing : false;
if(empty($types)) {
    return;
}
?>

<div class="tabset-holder">
    <ul class="tabset">

        <li class="<?= $isManufacturing ? 'active' : '' ?>">
            <a href="<?= GalleriesController::getProductionGalleryUrl() ?>">
                <?= Yii::t('app', 'Manufacturing') ?>
            </a>
        </li>

        <?php foreach($types as $type):
            /** @var \app\models\PoolTypeI18n|null $typeI18n */
            $typeI18n = $type->getI18n($language);
            if(empty($typeI18n)) {
                continue;
            }
            ?>

            <li class="<?= !empty($activeType) && $activeType->getId() == $type->getId() ? 'active' : '' ?>">
                <a href="<?= GalleriesController::getTypeUrl($type) ?>">
                    <?= Html::encode($typeI18n->getName()) ?>
                </a>
            </li>

        <?php endforeach;?>

    </ul>
</div>
