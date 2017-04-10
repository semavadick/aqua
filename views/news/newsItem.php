<?php
/**
 * Новость
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\News $newsItem
 * @var \app\models\NewsI18n $newsItemI18n
 * @var \app\models\Product[] $products
 */

\app\assets\Article::register($this);

$this->setTitle($newsItemI18n->getPageTitle());
$this->setMetaKeywords($newsItemI18n->getPageMetaKeywords());
$this->setMetaDescription($newsItemI18n->getPageMetaDescription());
?>

<?= $this->render('/publications/_publicationHeader', [
    'language' => $language,
    'publication' => $newsItem,
]) ?>

<div class="center">
    <div class="knowledge-base">

        <aside class="aside"></aside>

        <div class="content">
            <?= $this->render('/publications/_publicationContent', [
                'language' => $language,
                'publication' => $newsItem,
            ]) ?>
        </div>

    </div>
</div>