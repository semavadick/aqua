<?php
/**
 * @var app\components\View $this
 * @var \app\models\Product $product
 * @var \app\models\ProductI18n $productI18n
 */

$images = $product->getImages();
?>

<div class="holder-gallery addition">
    <ul class="gallery">

        <?php foreach($images as $image): ?>

            <li>
                <img src="<?= $image->getMediumPath() ?>" />
            </li>

        <?php endforeach; ?>
    </ul>
    <div id="bx-pager" class="switcher">

        <?php foreach($images as $i => $image): ?>

            <a data-slide-index="<?= $i ?>" href="#" >
                <img src="<?= $image->getSmallPath() ?>" alt="image_description" width="83" height="62"  />
            </a>

        <?php endforeach; ?>

    </div>
</div>