<?php

use app\widgets\MyModal;

/**
 * Главная Строительство бассейнов
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PoolsBuildingPage $page
 * @var \app\models\PoolsBuildingPageI18n $pageI18n
 * @var \app\models\PoolType[] $types
 * @var \app\models\TechAdvantage[] $advantages
 * @var \app\models\ObjectGallery[] $galleries
 * @var \app\models\FaqItem[] $faqItems
 */

\app\assets\Building::register($this);

$this->setTitle($pageI18n->getTitle());
$this->setMetaKeywords($pageI18n->getMetaKeywords());
$this->setMetaDescription($pageI18n->getMetaDescription());

$consultModal = new MyModal();
$consultModal->id = 'consult-modal';
$consultModal->content = $this->render('index/_consultModal');
echo $consultModal->run();
?>

<?= $this->render('index/_types', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
    'types' => $types,
]) ?>

<?= $this->render('index/_advantages', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
    'advantages' => $advantages,
]) ?>

<?= $this->render('index/_services', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
]) ?>

<div class="order-block">
    <div class="center">
        <a href="#" class="btn consult-btn"><?= Yii::t('app', 'request a consultation') ?></a>
    </div>
</div>

<?= $this->render('general/_galleries', [
    'header' => Yii::t('app', 'GALLERY OF OBJECTS'),
    'language' => $language,
    'galleries' => $galleries,
]) ?>

<?= $this->render('index/_faq', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
    'faqItems' => $faqItems,
]) ?>
