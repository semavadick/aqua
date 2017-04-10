<?php

use yii\helpers\Html;

/**
 * @var \app\components\View $this
 * @var \app\controllers\StoreController $controller
 * @var \app\models\Language $language
 * @var \app\models\CategoryFilter[] $filters
 * @var \app\models\CategoryFilter|null $activeFilter
 */
?>

<div class="category-chooser-holder">
    <?php if(!empty($filters)):?>
    <ul class="category-chooser">
        <li>
            <a href="#" class="drop-btn"><?= Yii::t('app', 'filter the list') ?> <i class="ico"></i></a>
            <div class="drop">

                <?php foreach($filters as $i => $filter):
                    /** @var \app\models\CategoryFilterI18n|null $filterI18n */
                    $filterI18n = $filter->getI18n($language);
                    if(empty($filterI18n)) {
                        continue;
                    }
                    $checked = !empty($activeFilter) && $activeFilter->getId() == $filter->getId();
                    ?>

                    <div class="row-radio">
                        <input
                            name="filters"
                            id="alt<?= $i ?>"
                            type="radio"
                            <?= $checked ? 'checked' : '' ?>
                            data-url="<?= $controller->getCurrentUrlWithFilter($filter) ?>"
                        >
                        <label for="alt<?= $i ?>"><?= Html::encode($filterI18n->getText()) ?></label>
                    </div>

                <?php endforeach; ?>

            </div>
        </li>
    </ul>
    <?php endif;?>
    <ul class="wiev-choose">
        <li <?= ($grid_view == 'default') ? 'class="active"' : ''?>>
            <a href="#" data-grid-view="default">
                <span class="ico1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 23 23">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect id="Rectangle_4_copy" data-name="Rectangle 4 copy" x="3" y="13" width="7" height="7"/>
                        <rect id="Rectangle_4_copy_2" data-name="Rectangle 4 copy 2" x="13" y="3" width="7" height="7"/>
                        <rect id="Rectangle_4_copy_2-2" data-name="Rectangle 4 copy 2" x="13" y="13" width="7" height="7"/>
                    </svg>
                </span>
            </a>
        </li>
        <li <?= ($grid_view == 'list-view') ? 'class="active"' : ''?>>
            <a href="#" data-grid-view="list-view">
                <span class="ico2">
                     <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 23 23">
                         <rect class="cls-1" x="-0.25" y="3" width="7" height="7"/>
                         <rect id="Rectangle_4_copy" data-name="Rectangle 4 copy" class="cls-1" x="-0.25" y="13" width="7" height="7"/>
                         <path class="cls-2" d="M1217,380h13" transform="translate(-1207.25 -374)"/>
                         <path id="Shape_9_copy" data-name="Shape 9 copy" class="cls-2" d="M1217,390h13" transform="translate(-1207.25 -374)"/>
                     </svg>
                </span>
            </a>
        </li>
        <li <?= ($grid_view == 'long-list-view') ? 'class="active"' : ''?>>
            <a href="#" data-grid-view="long-list-view">
                <span class="ico2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 23 23">
                        <rect class="cls-1" x="-0.25" y="3" width="3" height="3"/>
                        <path class="cls-2" d="M1252,378h16" transform="translate(-1245.25 -374)"/>
                        <rect id="Rectangle_4_copy_3" data-name="Rectangle 4 copy 3" class="cls-1" x="-0.25" y="17" width="3" height="3"/>
                        <path id="Shape_9_copy_2" data-name="Shape 9 copy 2" class="cls-2" d="M1252,392h16" transform="translate(-1245.25 -374)"/>
                        <rect id="Rectangle_4_copy_4" data-name="Rectangle 4 copy 4" class="cls-1" x="-0.25" y="10" width="3" height="3"/>
                        <path id="Shape_9_copy_3" data-name="Shape 9 copy 3" class="cls-2" d="M1252,385h16" transform="translate(-1245.25 -374)"/>
                    </svg>
                </span>
            </a>
        </li>
    </ul>
</div>
