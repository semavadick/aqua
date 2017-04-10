<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PublicationGallery $gallery
 */

$images = $gallery->getImages();
if(empty($images)) {
    return;
}
?>

<div class="gallery-holder">
    <ul class="gallery">

        <?php foreach($images as $image):
            /** @var \app\models\PublicationGalleryImageI18n|null $imageI18n */
            $imageI18n = $image->getI18n($language);
            if(empty($imageI18n)) {
                continue;
            }
            ?>

            <li>
                <img src="<?= $image->getMediumPath() ?>"  alt="<?= Html::encode($imageI18n->getName()) ?>">
                <span class="title"><?= Html::encode($imageI18n->getName()) ?></span>
            </li>

        <?php endforeach; ?>

    </ul>
</div>
