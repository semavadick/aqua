<?php

use yii\helpers\Html;
use app\controllers\StoreController;

/**
 * Каталог оборудования
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Category $category
 * @var \app\models\CategoryI18n $categoryI18n
 * @var \app\models\Category[] $categories
 * @var \app\models\CategoryFilter|null $activeFilter
 * @var \app\models\CategoryFilter[] $filters
 * @var \app\models\Product[] $products
 * @var \yii\data\Pagination $pagination
 * @var \app\models\Product[] $relatedProducts
 */

\app\assets\Store::register($this);

$this->setTitle($categoryI18n->getPageTitle());
$this->setMetaKeywords($categoryI18n->getPageMetaKeywords());
$this->setMetaDescription($categoryI18n->getPageMetaDescription());
?>

<div class="center">

    <?= $this->render('general/_breadcrumbs', [
        'category' => $category,
    ]) ?>

    <div class="catalog-group">
        <div class="title" style="background: url(<?= $category->getBgPath() ?>) no-repeat 50% 0%">
            <h2><?= Html::encode($categoryI18n->getName()) ?></h2>
            <p><?= $categoryI18n->getDescription() ?></p>
        </div>

        <?= $this->render('store/_menu', [
            'language' => $language,
            'activeCategory' => $category,
            'categoryI18n' => $categoryI18n,
            'categories' => $categories,
        ]) ?>

        <div class="content">
            <?= $this->render('store/_filters', [
                'controller' => $this->context,
                'language' => $language,
                'filters' => $filters,
                'activeFilter' => $activeFilter,
                'grid_view' => $grid_view
            ]) ?>

            <?= $this->render('store/_grid', [
                'products' => $products,
                'pagination' => $pagination,
                'grid_view'  => $grid_view
            ]) ?>
        </div>
    </div>
</div>

<?= $this->render('general/_help', [

]) ?>

<?= $this->render('general/_relatedProducts', [
    'products' => $relatedProducts,
]) ?>
