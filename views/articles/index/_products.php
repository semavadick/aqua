<?php

use yii\helpers\Html;
use app\controllers\StoreController;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Product[] $products
 */
?>

<ul class="catalog">

    <?php foreach($products as $product): ?>

        <li>
            <?= $this->render('/store/general/_product', [
                'product' => $product,
            ]) ?>
        </li>

    <?php endforeach; ?>

</ul>