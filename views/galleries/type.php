<?php
/**
 * Галереи типа бассейна
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PoolType $type
 * @var \app\models\PoolTypeI18n $typeI18n
 * @var \app\models\ObjectGalleryI18n[] $galleries
 * @var \app\models\PoolType[] $types
 */

$title = Yii::t('app', 'Gallery of realized objects') . ' - ' . $typeI18n->getName();
$this->setTitle($title);
$this->setMetaKeywords($title);
$this->setMetaDescription($title);
?>

<div class="gallery-tabs">

    <?= $this->render('general/_types', [
        'language' => $language,
        'activeType' => $type,
        'types' => $types,
    ]) ?>

    <div style="margin-top: -30px;">
        <?= $this->render('/building/general/_galleries', [
            'header' => Yii::t('app', 'GALLERY OF REALIZED OBJECTS'),
            'language' => $language,
            'galleries' => $galleries,
        ]) ?>
    </div>

</div>
