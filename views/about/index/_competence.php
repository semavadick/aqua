<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AboutPage $page
 * @var \app\models\AboutPageI18n $pageI18n
 */
?>

<div class="competention" id="competence">
    <div class="center">
        <header class="main-head">
            <h2><?= Html::encode($pageI18n->getCompetenceTitle()) ?></h2>
        </header>
        <div class="visual-right">
            <img src="<?= $page->getCompetenceImageUrl() ?>"  alt="<?= Html::encode($pageI18n->getCompetenceTitle()) ?>">
        </div>
        <div class="text">
            <?= $pageI18n->getCompetenceText() ?>
        </div>
    </div>
</div>
