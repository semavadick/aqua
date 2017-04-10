<?php
/**
 * Статьи
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Article|null $topArticle
 * @var \app\models\Article[] $articles
 * @var \yii\data\Pagination $pagination
 * @var \app\models\Category|null $activeCategory
 * @var \app\models\Category[] $categories
 * @var \app\models\Product[] $products
 */

\app\assets\Articles::register($this);

$title = Yii::t('app', 'Knowledge base');
$this->setTitle($title);
$this->setMetaKeywords($title);
$this->setMetaDescription($title);
?>

<?= $this->render('/publications/_topPublication', [
    'controller' => $this->context,
    'language' => $language,
    'publication' => $topArticle,
]) ?>

<div class="center">
    <?= $this->render('index/_filters', [
        'language' => $language,
        'categories' => $categories,
        'activeCategory' => $activeCategory,
    ]) ?>

    <div class="knowledge-base">

        <aside class="aside">
            <?= $this->render('index/_products', [
                'language' => $language,
                'products' => $products,
            ]) ?>
        </aside>

        <div class="content">
            <?= $this->render('/publications/_publicationsGrid', [
                'controller' => $this->context,
                'language' => $language,
                'publications' => $articles,
                'pagination' => $pagination,
            ]) ?>
        </div>

    </div>

</div>
