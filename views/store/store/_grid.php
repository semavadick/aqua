<?php

use yii\helpers\Html;

/**
 * @var \app\components\View $this
 * @var \app\models\Product[] $products
 * @var \yii\data\Pagination $pagination
 */
?>

<ul class="catalog <?=$grid_view?>">

    <?php foreach($products as $product): ?>
        <li>
            <?= $this->render('/store/general/_product', [
                'product' => $product
            ]) ?>
        </li>

    <?php endforeach; ?>

</ul>

<?= $this->render('/general/_ajaxPagination', [
    'pagination' => $pagination,
    'containers' => [
        [
            'selector' => '.content .catalog',
            'itemsSelector' => '.content .catalog li',
            'afterLoad' => 'checkStoreProducts();'
        ],
    ],
]); ?>

<?php if(empty($products)): ?>
    <h1 class="not-found"><?= Yii::t('app', 'No products found') ?></h1>
<?php endif; ?>