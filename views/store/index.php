<?php

use yii\helpers\Html;
use app\controllers\StoreController;

/**
 * Каталог оборудования
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\CatalogPage $page
 * @var \app\models\CatalogPageI18n $pageI18n
 * @var \app\models\Category[] $categories
 */

\app\assets\Store::register($this);

$this->setTitle($pageI18n->getTitle());
$this->setMetaKeywords($pageI18n->getMetaKeywords());
$this->setMetaDescription($pageI18n->getMetaDescription());

$catalogModal = new \app\widgets\MyModal();
$catalogModal->id = 'store-catalog-modal';
$catalogModal->content = $this->render('index/_catalogModalContent');
echo $catalogModal->run();
?>

<div class="center">
    <div class="catalog-group-begin">
        <div class="content">
            <ul class="catalog">

                <?php foreach($this->context->getCategories() as $cats):?>
                    <?php foreach($cats as $category):?>
                        <?php
                        /** @var \app\models\CategoryI18n|null $categoryI18n */
                        $categoryI18n = $category->getI18n($language);
                        if(empty($categoryI18n)) {
                            continue;
                        }
                        ?>

                        <li>
                            <h3><?= Html::encode($categoryI18n->getName()) ?></h3>

                            <div class="visual-items">
                                <img src="<?= $category->getImagePath() ?>"  alt="<?= Html::encode($categoryI18n->getName()) ?>" />
                            </div>

                            <ul class="list-items">

                                <?php foreach($category->getChildren() as $child):
                                    /** @var \app\models\CategoryI18n|null $childI18n */
                                    $childI18n = $child->getI18n($language);
                                    if(empty($childI18n)) {
                                        continue;
                                    }
                                    ?>

                                    <li>
                                        <a href="<?= StoreController::getStoreUrl($child) ?>"><?= Html::encode($childI18n->getName()) ?></a>
                                    </li>

                                <?php endforeach; ?>

                            </ul>
                        </li>
                    <?php endforeach;?>
                <?php endforeach; ?>

                <li class="item7">
                    <h4><?= Yii::t('app', 'Special offer for wholesale partners on the entire range of the company:') ?></h4>
                    <div class="holder">
                        <strong><?= Yii::t('app', 'discount up to') ?></strong>
                        <span class="persent">50%</span>
                    </div>
                    <a href="#" class="btn btn-discount btn-disc"><?= Yii::t('app', 'find out more <br> about your benefits') ?></a>
                </li>

                <li class="item9">
                    <div class="visual">
                        <img src="<?= $pageI18n->getCatalogImagePath() ?>" height="237" width="172" />
                    </div>
                    <a href="#" class="btn btn-order-cat store-catalog-btn"><?= Yii::t('app', 'request a free catalogue') ?></a>
                </li>
            </ul>
        </div>
    </div>
</div>