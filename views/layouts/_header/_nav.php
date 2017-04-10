<?php

use yii\helpers\Html;
use app\controllers\AboutController;
use app\controllers\BuildingController;
use app\controllers\ServicesController;
use app\controllers\ArticlesController;
use app\controllers\NewsController;
use app\controllers\StoreController;

/**
 * Навигация
 *
 * @var app\components\View $this
 */

$isDesktop = !empty($isDesktop) ? $isDesktop : false;
$isMobile = !empty($isMobile) ? $isMobile : false;
$language = $this->context->getCurrentLanguage();
?>

<nav id="nav" class="<?= $isDesktop ? 'desktop' : '' ?> <?= $isMobile ? 'mobile' : '' ?>">

    <?php if($isMobile): ?>
        <div class="back"><a href="#"><?= Yii::t('app', 'back') ?></a></div>
    <?php endif; ?>

    <ul>

        <li class="has-drop">
            <a href="<?= AboutController::getIndexUrl() ?>"><?= Yii::t('app', 'about') ?></a>
            <div class="drop">
                <ul>
                    <li><a href="<?= AboutController::getIndexUrl('history') ?>"><?= Yii::t('app', 'company history') ?></a></li>
                    <li><a href="<?= AboutController::getIndexUrl('competence') ?>"><?= Yii::t('app', 'our competencies') ?></a></li>
                    <li><a href="<?= AboutController::getIndexUrl('manufacturing') ?>"><?= Yii::t('app', 'manufacturing') ?></a></li>
                    <li><a href="<?= AboutController::getIndexUrl('advantages') ?>"><?= Yii::t('app', 'our advantages') ?></a></li>
                    <li><a href="<?= AboutController::getIndexUrl('certificates') ?>"><?= Yii::t('app', 'certificates and patents') ?></a></li>
                    <li><a href="<?= NewsController::getIndexUrl() ?>"><?= Yii::t('app', 'news') ?></a></li>
                    <li><a href="<?= AboutController::getIndexUrl('contacts') ?>"><?= Yii::t('app', 'contacts') ?></a></li>
                </ul>
            </div>
        </li>

        <li class="has-drop">
            <a href="<?= BuildingController::getIndexUrl() ?>"><?= Yii::t('app', 'pools building') ?></a>
            <div class="drop">
                <ul>
                    <li><a href="<?= BuildingController::getIndexUrl('types') ?>"><?= Yii::t('app', 'pool types') ?></a></li>
                    <li><a href="<?= BuildingController::getIndexUrl('techs') ?>"><?= Yii::t('app', 'our technologies') ?></a></li>
                    <li><a href="<?= BuildingController::getIndexUrl('planning') ?>"><?= Yii::t('app', 'planning') ?></a></li>
                    <li><a href="<?= BuildingController::getIndexUrl('design') ?>"><?= Yii::t('app', 'design') ?></a></li>
                    <li><a href="<?= BuildingController::getIndexUrl('building') ?>"><?= Yii::t('app', 'building') ?></a></li>
                    <li><a href="<?= BuildingController::getIndexUrl('gallery') ?>"><?= Yii::t('app', 'gallery of objects') ?></a></li>
                    <li><a href="<?= BuildingController::getIndexUrl('faq') ?>"><?= Yii::t('app', 'questions and answers') ?></a></li>
                </ul>
            </div>
        </li>

        <li class="has-drop">
            <a href="<?= ServicesController::getMaintenanceUrl() ?>"><?= Yii::t('app', 'services') ?></a>
            <div class="drop">
                <ul>
                    <li><a href="<?= ServicesController::getExclusiveUrl() ?>"><?= Yii::t('app', 'exclusive stainless steel solutions') ?></a></li>
                    <li><a href="<?= ServicesController::getMaintenanceUrl() ?>"><?= Yii::t('app', 'pool maintenance') ?></a></li>
                </ul>
            </div>
        </li>

        <li class="has-drop">
            <a href="<?= StoreController::getIndexUrl() ?>"><?= Yii::t('app', 'store') ?></a>
            <div class="drop-items-holder">
                <ul class="drop-items">
                    <?php foreach($this->context->getCategories() as $cats):?>
                        <?php foreach($cats as $category):?>
                            <?php

                            $categoryI18n = $category->getI18n($language);
                            if(empty($categoryI18n)) {
                                continue;
                            }
                            ?>

                            <li>

                                <?php if($isDesktop): ?>
                                    <div class="visual">
                                        <img src="<?= $category->getImagePath() ?>"  alt="<?= Html::encode($categoryI18n->getName()) ?>" />
                                    </div>
                                <?php endif;?>

                                <div class="desc">
                                    <h3><?= Html::encode($categoryI18n->getName()) ?></h3>

                                    <ul class="drop-item-list">

                                        <?php foreach($category->getChildren() as $child):
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
                                </div>
                            </li>
                        <?php endforeach;?>
                    <?php endforeach; ?>

                    <li>
                        <ul class="offers-list">
                            <li>
                                <p><?= Yii::t('app', 'Special offer for wholesale partners on the entire range of the company:') ?></p>
                            </li>
                            <li>
                                <p><?= Yii::t('app', 'discount up to') ?></p>
                                <span class="persent">50%</span>
                            </li>
                            <li>
                                <a class="btn btn-disc" href="#"><?= Yii::t('app', 'find out more <br> about your benefits') ?></a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </li>
        <li>
            <a href="<?= ArticlesController::getIndexUrl() ?>"><?= Yii::t('app', 'knowledge base') ?></a>
        </li>
    </ul>

</nav>
