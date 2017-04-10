<?php

use yii\helpers\Html;

/**
 * Каталог оборудования
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AdditionProduct $product
 * @var \app\models\AdditionProductI18n $productI18n
 * @var \app\models\CatalogPageI18n $pageI18n
 * @var \app\models\AdditionProduct[] $relatedProducts
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
    'isOnOffer' => $product->getIsOnOffer(),
    'type' => 1,
    'discount' => $priceHelper->getDiscount($product)
];
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
?>
<div class="center">
    <?= $this->render('/store/general/_breadcrumbs', ['product' => $product]) ?>

    <div class="catalog-group addition">
        <div class="info">
            <div class="holder">
                <div class="holder-left">

                    <h3><?= Html::encode($productI18n->getName()) ?></h3>

                    <?= $this->render('addition_product/_gallery', [
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

                    <div class="options-box">
                        <?php
                        $options = [];
                        foreach($product->getOptions() as $option) {
                            $options[$option->getType()][$option->getId()] = $option;
                        }
                        ?>
                        <?php if(!empty($options[4])):?>
                            <div class="options-group" data-options-type="4">
                                <div class="options-group-header">
                                    <h5><?= Yii::t('app', 'Product diameter:') ?></h5>
                                    <div class="options">
                                        <?php foreach($options[4] as $option):?>
                                            <?php $option_params = [
                                                'main' => (int) $option->getMain(),
                                                'id' => $option->getId(),
                                                'type' => $option->getType(),
                                                'name' => $option->getI18n($language)->getName(),
                                                'value' => $option->getI18n($language)->getValue()
                                            ]?>
                                            <a class="option <?=($option->getMain()) ? 'selected' : ''?>" data-option="<?= Html::encode(json_encode($option_params)) ?>" href="#"><?= $option->getI18n($language)->getName()?></a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($options[3])):?>
                            <div class="options-group" data-options-type="3">
                                <div class="options-group-header">
                                    <h5><?= Yii::t('app', 'Product width:') ?></h5>
                                    <div class="options">
                                        <?php foreach($options[3] as $option):?>
                                            <?php $option_params = [
                                                'main' => (int) $option->getMain(),
                                                'id' => $option->getId(),
                                                'type' => $option->getType(),
                                                'name' => $option->getI18n($language)->getName(),
                                                'value' => $option->getI18n($language)->getValue()
                                            ]?>
                                            <a class="option <?=($option->getMain()) ? 'selected' : ''?>" href="#" data-option="<?= Html::encode(json_encode($option_params))?>"><?= $option->getI18n($language)->getName()?></a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($options[5])):?>
                            <div class="options-group" data-options-type="5">
                                <div class="options-group-header">
                                    <h5><?= Yii::t('app', 'Product length:') ?></h5>
                                    <div class="options">
                                        <?php foreach($options[5] as $option):?>
                                            <?php $option_params = [
                                                'main' => (int) $option->getMain(),
                                                'id' => $option->getId(),
                                                'type' => $option->getType(),
                                                'name' => $option->getI18n($language)->getName(),
                                                'value' => $option->getI18n($language)->getValue()
                                            ]?>
                                            <a class="option <?=($option->getMain()) ? 'selected' : ''?>" data-option="<?= Html::encode(json_encode($option_params)) ?>" href="#"><?= $option->getI18n($language)->getName()?></a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($options[2])):?>
                            <div class="options-group" data-options-type="2">
                                <div class="options-group-header">
                                    <h5><?= Yii::t('app', 'Product depth:') ?></h5>
                                    <div class="options">
                                        <?php foreach($options[2] as $option):?>
                                            <?php $option_params = [
                                                'main' => (int) $option->getMain(),
                                                'id' => $option->getId(),
                                                'type' => $option->getType(),
                                                'name' => $option->getI18n($language)->getName(),
                                                'value' => $option->getI18n($language)->getValue()
                                            ]?>
                                            <a class="option <?=($option->getMain()) ? 'selected' : ''?>" href="#" data-option="<?= Html::encode(json_encode($option_params))?>"><?= $option->getI18n($language)->getName()?></a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($options[1])):?>
                            <div class="options-group" data-options-type="1">
                                <div class="options-group-header">
                                    <h5><?= Yii::t('app', 'Additional equipment:') ?></h5>
                                    <div class="options">
                                        <?php foreach($options[1] as $option):?>
                                            <?php $option_params = [
                                                'main' => (int) $option->getMain(),
                                                'id' => $option->getId(),
                                                'type' => $option->getType(),
                                                'name' => $option->getI18n($language)->getName(),
                                                'value' => $option->getI18n($language)->getValue()
                                            ]?>
                                            <label>
                                            <span class="input-wrap">
                                                <input type="checkbox" class="option"  data-option="<?= Html::encode(json_encode($option_params))?>" />
                                            </span>
                                            <span class="label-text">
                                                <?= $option->getI18n($language)->getName()?>
                                            </span>
                                            </label>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
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

                <div class="tabs-container clearfix">
                    <ul class="tabset">
                        <li class="active">
                            <a href="#"><?= Yii::t('app', 'Description') ?></a>
                        </li>
                        <?php foreach($product->getTabs() as $tab):?>
                            <li>
                                <a href="#"><?=$tab->getI18n($language)->getName()?></a>
                            </li>
                        <?php endforeach;?>
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
                            </div>
                        </div>
                        <?php foreach($product->getTabs() as $tab):?>
                            <div class="tab">
                                <?= $this->render('product/_files', [
                                    'language' => $language,
                                    'product' => $product,
                                    'productI18n' => $productI18n,
                                ]) ?>
                                <div class="text">
                                    <div class="box">
                                        <?=$tab->getI18n($language)->getContent()?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            </div>
        </div>
    </div>

<?= $this->render('general/_help', [

]) ?>

<?= $this->render('general/_relatedProducts', [
    'products' => $relatedProducts
]) ?>


