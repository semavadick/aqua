<?php

use yii\helpers\Html;
use app\controllers\BuildingController;

/**
 * @var app\components\View $this
 * @var string $header
 * @var \app\models\Language $language
 * @var \app\models\ObjectGallery[] $galleries
 */

/** @var \app\models\ObjectGalleryImage[] $images */
$images = [];
foreach($galleries as $gallery) {
    $image = $gallery->getPreviewImage();
    if(!empty($image)) {
        $images[] = $image;
    }
}
if(empty($images)) {
    return;
}

?>

<div class="gallery-object" id="gallery">
    <div class="center">
        <header class="main-head">
            <h3><?= $header ?></h3>
        </header>
    </div>
    <div class="box">

        <?php $i = 0; foreach($images as $image):
            $gallery = $image->getGallery();
            /** @var \app\models\ObjectGalleryI18n $galleryI18n */
            $galleryI18n = $gallery->getI18n($language);
            if(empty($galleryI18n)) {
                continue;
            }
            $i++;
            ?>

            <div class="item item<?= $i ?>">
                <a href="<?= BuildingController::getGalleryUrl($gallery) ?>">
                    <div class="visual">
                        <img src="<?= $image->getMediumPath() ?>" alt="<?= Html::encode($galleryI18n->getName()) ?>">
                    </div>
                    <div class="hidden-block">
                        <div class="holder">
                            <div class="frame">
                                <h3><?= nl2br(Html::encode($galleryI18n->getShortDescription())) ?></h3>
                                <i class="ico-arr"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php endforeach;?>

    </div>
</div>