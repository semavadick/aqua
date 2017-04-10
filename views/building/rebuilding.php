<?php
/**
 * Статическая страница Реконструкция
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 */

use app\widgets\MyModal;

\app\assets\Rebuilding::register($this);

$this->setTitle($rebuildingI18n->getPageTitle());
$this->setMetaKeywords($rebuildingI18n->getPageMetaKeywords());
$this->setMetaDescription($rebuildingI18n->getPageMetaDescription());
?>

<div class="rebuilding-page">
    <?= $this->render('/building/rebuilding/_header', [
        'language' => $language,
        'rebuilding' => $rebuilding,
    ]) ?>

    <?= $this->render('/building/rebuilding/_content', [
        'language' => $language,
        'rebuilding' => $rebuilding
    ]) ?>
    <?php
    $rebuildingModal = new \app\widgets\MyModal();
    $rebuildingModal->id = 'rebuilding-modal';
    $rebuildingModal->content = $this->render('/building/rebuilding/_modal', [
        'language' => $language,
    ]);
    echo $rebuildingModal->run();
    ?>

    <?= $this->render('general/_galleries', [
        'header' => Yii::t('app', 'GALLERY OF REALIZED OBJECTS'),
        'language' => $language,
        'galleries' => $objectGalleries,
    ]) ?>
</div>