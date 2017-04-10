<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 */

/** @var \app\models\PoolsBuildingStaticI18n|null $rebuildingI18n */
$rebuildingI18n = $rebuilding->getI18n($language);
if(empty($rebuildingI18n)) {
    return;
}

$description = $rebuildingI18n->getDescription();
$gallery = $rebuilding->getGalleries();
$galleryPattern = '/\\[\\[~GALLERY~\\]\\]/';
$actionPattern = '/\\[\\[~BUTTON~\\]\\]/';
while(preg_match($galleryPattern, $description)) {
    if(!empty($gallery)) {
        $gallery = array_shift($gallery);
        $renderedGallery = $this->render('/building/rebuilding/_gallery', [
            'language' => $language,
            'gallery' => $gallery,
        ]);
    } else {
        $renderedGallery = '';
    }
    $description = preg_replace($galleryPattern, $renderedGallery, $description, 1);
}
if (preg_match($actionPattern, $description)) $description = preg_replace($actionPattern, '<a class="btn send-application" href="#">свяжитесь с нами</a>', $description, 1);
?>

<div class="rebuilding-content center article">
    <div class="box">
        <?php if(!empty($rebuildingI18n->getShortDescription())):?>
        <div class="short-descr">
            <?= Html::encode($rebuildingI18n->getShortDescription()) ?>
        </div>
    <?php endif;?>
        <div class="text">
            <?= $description ?>
        </div>
    </div>
</div>

    <div class="order-block">
        <div class="center">
            <a href="#" class="btn rebuilding-request"><?= Yii::t('app', 'request calculation') ?></a>
        </div>
    </div>
