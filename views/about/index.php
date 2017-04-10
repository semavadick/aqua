<?php
/**
 * Главная О компании
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AboutPage $page
 * @var \app\models\AboutPageI18n $pageI18n
 * @var \app\models\HistoryStage[] $historyStages
 * @var \app\models\ProductionBanner[] $banners
 * @var \app\models\ProductionImage[] $images
 * @var \app\models\Advantage[] $advantages
 * @var \app\models\Certificate[] $certificates
 * @var \app\models\News[] $news
 * @var \app\models\OfficeRegion[] $regions
 */

\app\assets\About::register($this);

$this->setTitle($pageI18n->getTitle());
$this->setMetaKeywords($pageI18n->getMetaKeywords());
$this->setMetaDescription($pageI18n->getMetaDescription());
?>

<?= $this->render('index/_history', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
    'historyStages' => $historyStages,
]) ?>

<?= $this->render('index/_competence', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
]) ?>

<?= $this->render('index/_manufacturing', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
    'banners' => $banners,
    'images' => $images,
]) ?>

<?= $this->render('index/_advantages', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
    'advantages' => $advantages,
]) ?>

<?= $this->render('index/_certificates', [
    'language' => $language,
    'page' => $page,
    'pageI18n' => $pageI18n,
    'certificates' => $certificates,
]) ?>

<?= $this->render('index/_news', [
    'language' => $language,
    'news' => $news,
]) ?>

<?= $this->render('index/_contacts', [
    'language' => $language,
    'regions' => $regions,
]) ?>

