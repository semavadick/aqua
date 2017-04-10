<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\MainPageBanner[] $banners
 */

if(empty($banners)) {
    return;
}
?>

<ul class="info-list">

    <?php foreach($banners as $banner):
        /** @var \app\models\MainPageBannerI18n|null $bannerI18n */
        $bannerI18n = $banner->getI18n($language);
        if(empty($bannerI18n)) {
            continue;
        }
        ?>

        <li>
            <a href="<?= $bannerI18n->getLink() ?>">
                <div class="visual">
                    <img src="<?= $banner->getImagePath() ?>" alt="<?= Html::encode($bannerI18n->getText()) ?>">
                </div>
                <div class="text">
                    <?= $bannerI18n->getText() ?>
                </div>
            </a>
        </li>

    <?php endforeach; ?>

</ul>