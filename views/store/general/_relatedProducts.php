<?php
/**
 * @var \app\components\View $this
 * @var \app\models\Product[] $products
 * @var \app\models\Language $language
 */

if(empty($products)) {
    return;
}
?>

<div class="more-items-box">
    <div class="center">
        <header class="main-head">
            <h3><?= Yii::t('app', 'SEE ALSO') ?></h3>
        </header>
        <ul class="catalog">

            <?php foreach($products as $product): ?>

                <li>
                    <?= $this->render('/store/general/_product', [
                        'product' => $product,
                    ]) ?>
                </li>

            <?php endforeach; ?>

        </ul>
    </div>
</div>