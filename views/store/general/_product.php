<?php

use yii\helpers\Html;
use app\controllers\StoreController;

/**
 * @var \app\components\View $this
 * @var \app\models\Product $product
 * @var \app\models\Language $language
 */

$language = $this->context->getCurrentLanguage();
/** @var \app\models\ProductI18n|null $productI18n */
$productI18n = $product->getI18n($language);
if(empty($productI18n)) {
    return;
}
$priceHelper = $this->context->getPriceHelper();

$params = [
    'id' => $product->getId(),
    'sku' => $product->getSku(),
    'name' => $productI18n->getName(),
    'quantity' => 1,
    'price' => $priceHelper->getPrice($product),
    'isOnOffer' => $product->getIsOnOffer(),
    'type' => 0,
    'discount' => $priceHelper->getDiscount($product)
];

if($product instanceof \app\models\AdditionProduct) {
    $params['type'] = 1;
    if($product->getOptions()) {
        foreach($product->getOptions() as $option) {
            if($option->getMain()) {
                $params['options'][$option->getId()] = [
                    'id' => $option->getId(),
                    'main' => 1,
                    'type' => $option->getType(),
                    'name' => $option->getI18n($language)->getName(),
                    'value' => $option->getI18n($language)->getValue()
                ];
            }
        }
    }
}
?>

<a href="<?= StoreController::getProductUrl($product) ?>">
    <div class="visual">
        <img src="<?= $product->getPreviewPath() ?>"  alt="<?= Html::encode($productI18n->getName()) ?>" />
    </div>
    <header class="head">
        <h3><?= Html::encode($productI18n->getName()) ?></h3>
        <span class="cod"><?= Html::encode($product->getSku()) ?></span>
    </header>
</a>
<div class="holder">
    <div class="price-holder">
    <?php if($priceHelper->getDiscount($product) && $product->getPrice() > 0 && $language->getId() == $language::ID_RU && $product->getIsOnOffer()):?>
        <span class="price with-discount"><?= $priceHelper->getFormattedPrice($product, true) ?></span>
        <span class="price-without-discount"><?= $priceHelper->getFormattedPrice($product) ?></span>
    <?php else:?>
        <span class="price"><?= $priceHelper->getFormattedPrice($product) ?></span>
    <?php endif;?>
    </div>
    <div class="add-to-cart-holder">
        <?php if($product->getPrice() > 0):?>
        <div class="count">
            <span>Кол-во:</span>
            <div class="amount">
                <input value="1" type="text">
                <a href="#" class="plus"></a>
                <a href="#" class="minus"></a>
            </div>
        </div>
        <?php endif;?>
        <a
            class="btn-basket add-to-cart <?
            if ($product->getIsOnOffer()){
                if($product->getPrice() <= 0 || $language->getId() != $language::ID_RU) echo 'unavailable';
            }
            else {echo 'unavailable';}
            ?>"
            data-params="<?= Html::encode(json_encode($params)) ?>"
            href="#"
            data-add="<?= Yii::t('app', 'add to cart') ?>"
            data-added="<?= Yii::t('app', 'added to cart') ?>"
            >
            <? if ($product->getIsOnOffer()){
                if ($product->getPrice() <= 0 || $language->getId() != $language::ID_RU) echo Yii::t('app', 'call us');
                else echo Yii::t('app', 'add to cart');
            }
            else {echo Yii::t('app', 'not available');} ?>
        </a>
    </div>
</div>
