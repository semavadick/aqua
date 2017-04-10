<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 */

/** @var \app\models\PoolsBuildingStaticI18n|null $rebuildingI18n */
$rebuildingI18n = $rebuilding->getI18n($language);
if(empty($rebuildingI18n)) {
    return;
}
?>
<div class="rebuilding-header center-head">
    <h1><?= Html::encode($rebuildingI18n->getName()) ?></h1>
    <div class="head" style="background-image: url(<?= $rebuilding->getBgPath() ?>)"></div>
</div>

