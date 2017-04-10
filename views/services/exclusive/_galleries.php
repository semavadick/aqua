<?php

use yii\helpers\Html;
use app\controllers\AboutController;

/**
 * @var app\components\View $this
 * @var string $header
 * @var \app\models\Language $language
 */


?>

<div class="gallery-object" id="gallery">
    <div class="center">
        <header class="main-head">
            <h3><?= $header ?></h3>
        </header>
    </div>
    <div class="box">

        <?php $i = 0; foreach($images as $image):
            /** @var \app\models\ProductionImageI18n|null $imageI18n */
            $imageI18n = $image->getI18n($language);
            if(empty($imageI18n)) {
                continue;
            }
            $i++;
            ?>

            <div class="item item<?= $i ?>">
                <a href="<?= AboutController::getProductionGalleryUrl() ?>">
                    <div class="visual">
                        <img src="<?= $image->getMediumImageUrl() ?>" alt="<?= strip_tags($imageI18n->getText()) ?>">
                    </div>
                    <div class="hidden-block">
                        <div class="holder">
                            <div class="frame">
                                <h3><?= $imageI18n->getText() ?></h3>
                                <i class="ico-arr"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php endforeach;?>

    </div>
</div>