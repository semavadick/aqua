<?php

use yii\helpers\Html;

/**
 * Галерея объекта
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\ObjectGallery $gallery
 * @var \app\models\ObjectGalleryI18n $galleryI18n
 * @var \app\models\PoolType|null $activeType
 * @var \app\models\PoolType[] $types
 */

\app\assets\Galleries::register($this);

$this->setTitle($galleryI18n->getPageTitle());
$this->setMetaKeywords($galleryI18n->getPageMetaKeywords());
$this->setMetaDescription($galleryI18n->getPageMetaDescription());
?>

<div class="gallery-tabs">

    <?= $this->render('general/_types', [
        'language' => $language,
        'activeType' => $activeType,
        'types' => $types,
    ]) ?>

    <div class="tab-body">
        <div class="tab active">
            <div class="descr">

                <h3><?= Html::encode($galleryI18n->getName()) ?></h3>
                <?= $galleryI18n->getDescription() ?>

                <a href="#" class="btn btn-calc"><?= Yii::t('app', 'request calculation') ?></a>

            </div>

            <div class="gallery-holder">
                <ul class="gallery">

                    <?php foreach($gallery->getImages() as $image):
                        ?>

                        <li>
                            <img src="<?= $image->getBigPath() ?>" alt="<?= Html::encode($galleryI18n->getName()) ?>" />
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>

        </div>
    </div>
</div>

<?= $this->render('/services/general/_calcModal', [
    'language' => $language,
]) ?>