<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Order $order
 */

$priceHelper = $this->context->getPriceHelper();
$productsData = [];
foreach($order->getOrderProducts() as $orderProduct) {
    $product = $orderProduct->getProduct();
    if(empty($product) || !$product->getIsOnOffer()) {
        continue;
    }
    $productsData[] = [
        'id' => $product->getId(),
        'name' => $product->getName($this->context->getCurrentLanguage()),
        'sku' => $product->getSku(),
        'price' => $priceHelper->getPrice($product),
        'quantity' => $orderProduct->getQuantity(),
        'type' => 0,
        'discount' => $priceHelper->getDiscount($product)
    ];
}

foreach($order->getOrderAdditionProducts() as $orderProduct) {
    $product = $orderProduct->getProduct();
    if(empty($product) || !$product->getIsOnOffer()) {
        continue;
    }
    $params = [
        'id' => $product->getId(),
        'name' => $product->getName($language),
        'sku' => $product->getSku(),
        'price' => $priceHelper->getPrice($product),
        'quantity' => $orderProduct->getQuantity(),
        'type' => 1,
        'discount' => $priceHelper->getDiscount($product)
    ];

    if($orderProduct->getOptions()) {
        foreach($orderProduct->getOptions() as $option) {
            $params['options'][$option->getId()] = [
                'id' => $option->getId(),
                'main' => $option->getMain(),
                'type' => $option->getType(),
                'name' => $option->getI18n($language)->getName(),
                'value' => $option->getI18n($language)->getValue()
            ];
        }
    }
    $productsData[] = $params;
}
?>

<div class="modal-header">
    <?= Yii::t('app', 'Order details') ?>
</div>

<div class="order-details" id="popup-basket">
    <table>
        <thead>
        <tr>
            <th><?= Yii::t('app', 'name') ?></th>
            <th><?= Yii::t('app', 'sku') ?></th>
            <th><?= Yii::t('app', 'price') ?></th>
            <th><?= Yii::t('app', 'qty') ?></th>
            <th><?= Yii::t('app', 'cost') ?></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($order->getOrderProducts() as $orderProduct): ?>

            <tr class="cart-prod">
                <td class="cart-prod__name"><?= Html::encode($orderProduct->getName()) ?></td>
                <td class="cart-prod__sku"><?= Html::encode($orderProduct->getSku()) ?></td>
                <td class="cart-prod__price">
                    <?= $priceHelper->getFormattedOrderProductPrice($order, $orderProduct) ?>
                    <?php if(!empty($orderProduct->getDiscount())):?>
                        <div>(со скидкой <?=$orderProduct->getDiscount()?>%)</div>
                    <?php endif;?>
                </td>
                <td class="cart-prod__price"><?= $orderProduct->getQuantity() ?></td>
                <td class="cart-prod__price"><?= $priceHelper->getFormattedOrderProductTotalCost($order, $orderProduct) ?></td>
            </tr>

        <?php endforeach; ?>
        <?php foreach($order->getOrderAdditionProducts() as $orderProduct): ?>

            <tr class="cart-prod">
                <td class="cart-prod__name"><?= Html::encode($orderProduct->getName()) ?>
                    <div class="cart-prod__options">
                        <?php
                        $typeHeaders = array(
                            1 => 'Доп. оборудование',
                            4 => 'Диаметр',
                            3 => 'Ширина',
                            5 => 'Длина',
                            2 => 'Глубина',
                        );
                        ?>
                        <?php foreach($orderProduct->getOptions() as $index => $option):?>
                            <div class="option-header"><?= $typeHeaders[$option->getType()]?></div>
                            <span class="option-name"><?= $option->getI18n($language)->getName()?></span>
                            <?php if(!$option->getMain()):?>
                                <span class="option-value">
                                <?= $priceHelper->formatPrice($option->getI18n($language)->getValue())?>
                            </span>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </td>
                <td class="cart-prod__sku"><?= Html::encode($orderProduct->getSku()) ?></td>
                <td class="cart-prod__price">
                    <?= $priceHelper->getFormattedOrderProductPrice($order, $orderProduct) ?>
                    <?php if(!empty($orderProduct->getDiscount())):?>
                        <div>(со скидкой <?=$orderProduct->getDiscount()?>%)</div>
                    <?php endif;?>
                </td>
                <td class="cart-prod__price"><?= $orderProduct->getQuantity() ?></td>
                <td class="cart-prod__price"><?= $priceHelper->getFormattedOrderProductTotalCost($order, $orderProduct) ?></td>
            </tr>

        <?php endforeach; ?>

        </tbody>

        <tfoot>
        <tr>
            <td colspan="3"></td>
            <td><?= Yii::t('app', 'summary:') ?></td>
            <td colspan="2">
                <span class="title"><?= Yii::t('app', 'summary:') ?></span>
                <span class="total-price"><?= $priceHelper->getFormattedOrderPrice($order) ?></span>
            </td>
        </tr>
        </tfoot>
    </table>

    <div class="modal-form__btn__wrap">
        <button type="button" class="modal-form__btn" data-products="<?= Html::encode(json_encode($productsData)) ?>">
            <?= Yii::t('app', 'add to cart') ?>
        </button>
    </div>
</div>