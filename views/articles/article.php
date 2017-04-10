<?php
/**
 * Статья
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Article $article
 * @var \app\models\ArticleI18n $articleI18n
 * @var \app\models\Product[] $products
 */

\app\assets\Article::register($this);

$this->setTitle($articleI18n->getPageTitle());
$this->setMetaKeywords($articleI18n->getPageMetaKeywords());
$this->setMetaDescription($articleI18n->getPageMetaDescription());
?>

<?= $this->render('/publications/_publicationHeader', [
    'language' => $language,
    'publication' => $article,
]) ?>

<div class="center">
    <div class="knowledge-base">

        <aside class="aside">
            <aside class="aside">
                <?= $this->render('index/_products', [
                    'language' => $language,
                    'products' => $products,
                ]) ?>
            </aside>
        </aside>

        <div class="content">
            <?= $this->render('/publications/_publicationContent', [
                'language' => $language,
                'publication' => $article,
            ]) ?>
        </div>

    </div>
</div>