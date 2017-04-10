<?php

use yii\helpers\Html;
use app\controllers\ArticlesController;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Category|null $activeCategory
 * @var \app\models\Category[] $categories
 */
?>

<div class="category-chooser-holder">
    <ul class="category-chooser">
        <li>
            <select class="sl1">
                <option
                    <?= empty($activeCategory) ? 'selected' : '' ?>
                    data-url="<?= ArticlesController::getIndexUrl() ?>"
                >
                    <?= Yii::t('app', 'choose a category') ?>
                </option>


                <?php foreach($categories as $category):
                    /** @var \app\models\CategoryI18n|null $categoryI18n */
                    $categoryI18n = $category->getI18n($language);
                    if(empty($categoryI18n)) {
                        continue;
                    }
                    ?>

                        <option
                            <?= !empty($activeCategory) && $activeCategory->getId() == $category->getId() ? 'selected' : '' ?>
                            data-url="<?= ArticlesController::getIndexUrl($category) ?>"
                        >
                            <?= Html::encode($categoryI18n->getName()) ?>
                        </option>

                <?php endforeach;?>
            </select>
        </li>
    </ul>
</div>