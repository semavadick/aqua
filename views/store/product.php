<?php

use yii\helpers\Html;

/**
 * Каталог оборудования
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Product $product
 * @var \app\models\ProductI18n $productI18n
 * @var \app\models\CatalogPageI18n $pageI18n
 * @var \app\models\Product[] $relatedProducts
 */

\app\assets\Product::register($this);

$this->setTitle($productI18n->getPageTitle());
$this->setMetaKeywords($productI18n->getPageMetaKeywords());
$this->setMetaDescription($productI18n->getPageMetaDescription());

$priceHelper = $this->context->getPriceHelper();

$params = [
    'id' => $product->getId(),
    'sku' => $product->getSku(),
    'name' => $productI18n->getName(),
    'quantity' => 1,
    'price' => $priceHelper->getPrice($product),
    'discount' => $priceHelper->getDiscount($product),
    'isOnOffer' => $product->getIsOnOffer(),
];
?>
<div class="center">
    <?= $this->render('/store/general/_breadcrumbs', ['product' => $product]) ?>

    <div class="catalog-group">

        <?= $this->render('product/_gallery', [
            'language' => $language,
            'product' => $product,
            'productI18n' => $productI18n,
        ]) ?>

        <div class="info">
            <div class="holder">
                <div class="holder-left">

                    <h3><?= Html::encode($productI18n->getName()) ?></h3>
                    <span class="product-sku"><?= Yii::t('app', 'Sku:') ?> <?= Html::encode($product->getSku()) ?></span>

                    <?= $this->render('product/_attributes', [
                        'language' => $language,
                        'product' => $product,
                        'productI18n' => $productI18n,
                    ]) ?>

                </div>

                <div class="price-box">
                    <?php if($priceHelper->getDiscount($product) && $product->getPrice() > 0 && $language->getId() == $language::ID_RU && $product->getIsOnOffer()):?>
                        <span class="price with-discount"><?= $priceHelper->getFormattedPrice($product, true) ?></span>
                        <span class="price-without-discount"><?= $priceHelper->getFormattedPrice($product) ?></span>
                    <?php else:?>
                        <span class="price"><?= $priceHelper->getFormattedPrice($product) ?></span>
                    <?php endif;?>

                    <div class="count">
                        <span><?= Yii::t('app', 'Qty:') ?></span>
                        <div class="amount">
                            <input value="1" type="text">
                            <a href="#" class="plus"></a>
                            <a href="#" class="minus"></a>
                        </div>
                    </div>
                    <a
                        class="btn add-to-cart <?
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
                            else {echo Yii::t('app', 'not available');}
                        ?>
                    </a>
                </div>
            </div>

            <ul class="tabset">
                <li class="active">
                    <a href="#"><?= Yii::t('app', 'Description') ?></a>
                </li>
                <li>
                    <a href="#"><?= Yii::t('app', 'Delivery') ?></a>
                </li>
            </ul>

            <div class="tab-body">
                <div class="tab active">

                    <?= $this->render('product/_files', [
                        'language' => $language,
                        'product' => $product,
                        'productI18n' => $productI18n,
                    ]) ?>

                    <div class="text">
                        <div class="box">
                            <?= $productI18n->getDescription() ?>
                        </div>

                        <?= $this->render('product/_attachments', [
                            'language' => $language,
                            'product' => $product,
                            'productI18n' => $productI18n,
                        ]) ?>

                    </div>
                </div>

                <div class="tab">

                    <?= $this->render('product/_files', [
                        'language' => $language,
                        'product' => $product,
                        'productI18n' => $productI18n,
                    ]) ?>

                    <div class="text">
                        <div class="box">
                            <?= $pageI18n->getDeliveryDescription() ?>
                        </div>

                        <?= $this->render('product/_attachments', [
                            'language' => $language,
                            'product' => $product,
                            'productI18n' => $productI18n,
                        ]) ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->render('general/_help', [

]) ?>

<?= $this->render('general/_relatedProducts', [
    'products' => $relatedProducts,
    'language' => $language,
]) ?>


