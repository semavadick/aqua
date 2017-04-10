<?php

use yii\helpers\Html;
use app\controllers\StoreController;

/**
 * @var \app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Entity $activeCategory
 * @var \app\models\CategoryI18n $categoryI18n
 * @var \app\models\Entity[] $categories
 */
?>

<div class="sidebar">
    <div class="frame">

        <ul class="nav">

            <?php foreach($categories as $cats):?>

                <?php foreach($cats as $category) :?>
                    <?php
                    $categoryI18n = $category->getI18n($language);
                    if(empty($categoryI18n)) {
                        continue;
                    }
                    $active = $category->getId() == $activeCategory->getId() || $category->hasChild($activeCategory);
                    ?>

                    <li class="<?= $active ? 'active' : '' ?>">

                        <a class="<?= $active ? 'active' : '' ?>" href="<?= StoreController::getStoreUrl($category) ?>">
                            <?= Html::encode($categoryI18n->getName()) ?> <i class="ico"></i>
                        </a>

                        <ul class="nav-drop">

                            <?php foreach($category->getChildren() as $child):
                                /** @var \app\models\CategoryI18n|null $childI18n */
                                $childI18n = $child->getI18n($language);
                                if(empty($childI18n)) {
                                    continue;
                                }
                                ?>

                                <li class="<?= $child->getId() == $activeCategory->getId() ? 'active' : '' ?>">
                                    <a href="<?= StoreController::getStoreUrl($child) ?>">
                                        <?= Html::encode($childI18n->getName()) ?>
                                    </a>
                                </li>

                            <?php endforeach; ?>

                        </ul>
                    </li>
                <?php endforeach;?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
