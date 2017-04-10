<?php
/**
 * Главная страница
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\MainPage $page
 * @var \app\models\MainPageI18n $pageI18n
 * @var \app\models\MainPageSlide[] $slides
 * @var \app\models\MainPageBanner[] $banners
 * @var \app\models\News[] $news
 * @var \app\models\Article[] $articles
 */

\app\assets\Main::register($this);

$this->setTitle($pageI18n->getTitle());
$this->setMetaKeywords($pageI18n->getMetaKeywords());
$this->setMetaDescription($pageI18n->getMetaDescription());
?>

<?= $this->render('index/_slides', [
    'language' => $language,
    'slides' => $slides,
]) ?>

<div class="center">

    <?= $this->render('index/_banners', [
        'language' => $language,
        'banners' => $banners,
    ]) ?>

    <div class="about-company">
        <aside class="aside">

            <?= $this->render('index/_catalog', [
                'page' => $page,
                'pageI18n' => $pageI18n,
            ]) ?>

            <?= $this->render('index/_news', [
                'language' => $language,
                'news' => $news,
            ]) ?>

        </aside>

        <?= $this->render('index/_about', [
            'page' => $page,
            'pageI18n' => $pageI18n,
        ]) ?>

    </div>

    <?= $this->render('index/_articles', [
        'language' => $language,
        'articles' => $articles,
    ]) ?>

</div>