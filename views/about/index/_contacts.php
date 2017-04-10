<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AboutPage $page
 * @var \app\models\AboutPageI18n $pageI18n
 * @var \app\models\OfficeRegion[] $regions
 */
?>

<div class="contacts" id="contacts">
    <div class="center">
        <header class="main-head">
            <h3><?= Yii::t('app', 'CONTACTS') ?></h3>
        </header>
    </div>

    <?= $this->render('/addresses/_map', [
        'language' => $language,
        'regions' => $regions,
    ]); ?>
</div>