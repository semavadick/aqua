<?php

use yii\helpers\Html;
use app\controllers\StoreController;

/**
 * @var \app\components\View $this
 * @var \app\models\Category|null $category
 * @var \app\models\Product|null $product
 */

if(empty($category) && !empty($product)) {
    $category = $product->getCategory();
}
$language = $this->context->getCurrentLanguage();


/** @var \app\models\CategoryI18n|null $categoryI18n */
$categoryI18n = !empty($category) ? $category->getI18n($language) : null;

$parent = !empty($category) ? $category->getParent() : null;
/** @var \app\models\CategoryI18n|null $parentI18n */
$parentI18n = !empty($parent) ? $parent->getI18n($language) : null;

/** @var \app\models\ProductI18n|null $productI18n */
$productI18n = !empty($product) ? $product->getI18n($language) : null;
?>

<ul class="breadcrumps">
    <li>
        <a href="<?= StoreController::getIndexUrl() ?>"><?= Yii::t('app', 'store') ?></a>
    </li>

    <?php if(!empty($parentI18n)): ?>
        <li>
            <a href="<?= StoreController::getStoreUrl($parent) ?> "><?= Html::encode($parentI18n->getName()) ?></a>
        </li>
    <?php endif; ?>

    <?php if(!empty($categoryI18n)): ?>
        <li class="<?= empty($product) ? 'active' : null ?>">
            <a href="<?= StoreController::getStoreUrl($category) ?> "><?= Html::encode($categoryI18n->getName()) ?></a>
        </li>
    <?php endif; ?>

    <?php if(!empty($productI18n)): ?>
        <li class="active">
            <a href="<?= StoreController::getProductUrl($product) ?> "><?= Html::encode($productI18n->getName()) ?></a>
        </li>
    <?php endif; ?>
</ul>