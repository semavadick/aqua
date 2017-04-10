<?php

use yii\helpers\Html;
use app\controllers\AboutController;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AboutPage $page
 * @var \app\models\AboutPageI18n $pageI18n
 * @var \app\models\ProductionBanner[] $banners
 * @var \app\models\ProductionImage[] $images
 */
?>

<div class="production" id="manufacturing">
    <div class="center">
        <header class="main-head">
            <h2><?= Html::encode($pageI18n->getProductionTitle()) ?></h2>
        </header>

        <?php if(!empty($images)): ?>
            <div class="visual-right">
                <ul class="img-list">
                    <?php foreach($images as $image):
                        /** @var \app\models\ProductionImageI18n|null $imageI18n */
                        $imageI18n = $image->getI18n($language);
                        if(empty($imageI18n)) {
                            continue;
                        }
                        ?>

                        <li>
                            <a href="<?= AboutController::getProductionGalleryUrl() ?>">
                                <div class="visual">
                                    <img src="<?= $image->getMediumImageUrl() ?>">
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
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="text">
            <?= $pageI18n->getProductionText() ?>

            <?php if(!empty($banners)): ?>
                <ul class="list-product">
                    <?php foreach($banners as $banner):
                        /** @var \app\models\ProductionBannerI18n|null $bannerI18n */
                        $bannerI18n = $banner->getI18n($language);
                        if(empty($bannerI18n)) {
                            continue;
                        }
                        ?>

                        <li>
                            <a href="<?= $bannerI18n->getLink() ?>">
                                <h3><?= $bannerI18n->getText() ?></h3>
                                <div class="visual">
                                    <img src="<?= $banner->getImageUrl() ?>">
                                </div>
                            </a>
                        </li>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
