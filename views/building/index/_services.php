<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PoolsBuildingPage $page
 * @var \app\models\PoolsBuildingPageI18n $pageI18n
 */
?>

<div class="building-steps">
    <div class="center">
        <ul class="list">
            
            <li class="item1" id="planning">
                <header class="main-head">
                    <h2><?= Html::encode($pageI18n->getProjectTitle()) ?></h2>
                </header>
                <div class="visual-right">
                    <img src="<?= $page->getProjectImagePath() ?>"  alt="<?= Html::encode($pageI18n->getProjectTitle()) ?>">
                </div>
                <div class="text">
                    <i class="ico-item">
                        <img src="<?= $page->getProjectIconPath() ?>" alt="<?= Html::encode($pageI18n->getProjectTitle()) ?>">
                    </i>
                    <?= $pageI18n->getProjectText() ?>
                    <a href="<?= $pageI18n->getProjectPresentationPath() ?>" target="_blank" class="btn"><?= Yii::t('app', 'download presentation') ?> <i class="ico"></i></a>
                </div>
            </li>
            
            <li>
                <header class="main-head" id="design">
                    <h2><?= Html::encode($pageI18n->getDesignTitle()) ?></h2>
                </header>
                <div class="visual-right">
                    <img src="<?= $page->getDesignImagePath() ?>"  alt="<?= Html::encode($pageI18n->getDesignTitle()) ?>">
                </div>
                <div class="text">
                    <i class="ico-item">
                        <img src="<?= $page->getDesignIconPath() ?>" alt="<?= Html::encode($pageI18n->getDesignTitle()) ?>">
                    </i>
                    <?= $pageI18n->getDesignText() ?>
                    <a href="<?= $pageI18n->getDesignPresentationPath() ?>" target="_blank" class="btn"><?= Yii::t('app', 'download presentation') ?> <i class="ico"></i></a>
                </div>
            </li>
            
            <li>
                <header class="main-head" id="building">
                    <h2><?= Html::encode($pageI18n->getBuildingTitle()) ?></h2>
                </header>
                <div class="visual-right">
                    <img src="<?= $page->getBuildingImagePath() ?>"  alt="<?= Html::encode($pageI18n->getBuildingTitle()) ?>">
                </div>
                <div class="text">
                    <i class="ico-item">
                        <img src="<?= $page->getBuildingIconPath() ?>" alt="<?= Html::encode($pageI18n->getBuildingTitle()) ?>">
                    </i>
                    <?= $pageI18n->getBuildingText() ?>
                    <a href="<?= $pageI18n->getBuildingPresentationPath() ?>" target="_blank" class="btn"><?= Yii::t('app', 'download presentation') ?> <i class="ico"></i></a>
                </div>
            </li>
            
        </ul>
    </div>
</div>