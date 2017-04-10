<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\controllers\StoreController;

/**
 * Контент модального окна корзины
 *
 * @var app\components\View $this
 */

$cartProds = [];
$priceHelper = $this->context->getPriceHelper();
foreach($this->context->getWebUser()->getCartProducts() as $product) {
    $prod = [
        'id' => $product->getId(),
        'name' => $product->getName($this->context->getCurrentLanguage()),
        'sku' => $product->getSku(),
        'price' => $priceHelper->getPrice($product),
        'quantity' => $product->getCartQuantity(),
        'type' => ($product instanceof \app\models\AdditionProduct) ? 1 : 0,
        'discount' => $priceHelper->getDiscount($product)
    ];
    if($product instanceof \app\models\AdditionProduct) {
        if($product->getCartOptions()){
            $prod['options'] = $product->getCartOptions();
        }
    }
    $cartProds[] = $prod;
}
$wUser = $this->context->getWebUser();
?>

<div class="modal-header">
    <?= Yii::t('app', 'My cart') ?>
</div>

<table id="cart-table">
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
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td><?= Yii::t('app', 'summary:') ?></td>
        <td colspan="2">
            <span class="title"><?= Yii::t('app', 'summary:') ?></span>
            <span class="total-price" id="cart-summary"></span>
        </td>
    </tr>
    </tfoot>
</table>

<div class="cart-empty">
    <?= Yii::t('app', 'Cart is empty') ?>
</div>

<div class="cart-success">
    <?= Yii::t('app', 'You order has been sent successfully. Our manager will contact you soon') ?>
</div>

<?php
$model = new \app\forms\OrderForm();
$model->wUser = $wUser;
$form = ActiveForm::begin([
    'id' => 'order-form',
    'method' => 'POST',
    'action' => Url::to(['store/create-order']),
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

if($wUser->getIsGuest()) {
    echo $form->field($model, 'fullName')->textInput([
        'placeHolder' => $model->getAttributeLabel('fullName'),
    ]);

    echo $form->field($model, 'phone')->textInput([
        'placeHolder' => $model->getAttributeLabel('phone'),
    ]);

    echo $form->field($model, 'email')->textInput([
        'placeHolder' => $model->getAttributeLabel('email'),
    ]);
    echo $this->render('/general/_regFormFile', [
        'form' => $form,
        'model' => $model,
        'attribute' => 'uFile',
    ]);
}
?>

<div class="cart-note">
    <?= Yii::t('app', 'After you send the order our managers will contact you to clarify delivery details') ?>
</div>


<div class="modal-form__btn__wrap">
    <button type="submit" class="modal-form__btn">
        <?= Yii::t('app', 'send the order') ?>
    </button>
</div>

<?php $form->end();?>

<div id="cart-data" style="display: none;"
     data-sync-url="<?= StoreController::getSyncCartUrl() ?>"
     data-products="<?= Html::encode(json_encode($cartProds)) ?>"
     data-currency="<?= $this->context->getCurrency()->getId() ?>"
></div>
