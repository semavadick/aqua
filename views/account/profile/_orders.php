<?php
/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\User $user
 * @var \app\models\Order[] $orders
 */

if(empty($orders)) {
    return;
}
$priceHelper = $this->context->getPriceHelper();
foreach($orders as $order) {
    $modal = new \app\widgets\MyModal();
    $modalId = 'order-' . $order->getId();
    $modal->setId($modalId);
    $modal->content = $this->render('_orderModalContent', [
        'language' => $language,
        'order' => $order,
    ]);
    echo $modal->run();
}
?>
<div class="history">
    <header class="main-head">
        <h4><?= Yii::t('app', 'HISTORY OF YOUR ORDERS') ?></h4>
    </header>
    <table>
        <thead>
        <tr>
            <th>№</th>
            <th><?= Yii::t('app', 'Date') ?></th>
            <th><?= Yii::t('app', 'Order summary') ?></th>
            <th><?= Yii::t('app', 'Status') ?></th>
            <th><?= Yii::t('app', 'Order list') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order):
            $modalId = 'order-' . $order->getId();
            ?>

            <tr>
                <td><?= $order->getId() ?></td>
                <td><?= $order->getFormattedDate() ?></td>
                <td><strong><?= $priceHelper->getFormattedOrderPrice($order) ?></strong></td>
                <td><?= $order->getStatusLabelI18n() ?></td>
                <td><a href="#" class="btn order-modal-btn" data-id="<?= $modalId ?>"><?= Yii::t('app', 'open list') ?></a></td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>