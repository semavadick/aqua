<?php

use yii\helpers\Html;
use app\controllers\BuildingController;
/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PoolsBuildingPage $page
 * @var \app\models\PoolsBuildingPageI18n $pageI18n
 * @var \app\models\PoolType[] $types
 */

if(empty($types)) {
    return;
}
?>

<div class="offers" id="types">
    <div class="center">
        <header class="main-head">
            <h3><?= Yii::t('app', 'WHAT WE CAN DO FOR YOU:') ?></h3>
        </header>
    </div>
    <div class="box">

        <?php $i = 0; foreach($types as $type):
            /** @var \app\models\PoolTypeI18n|null $typeI18n */
            $typeI18n = $type->getI18n($language);
            if(empty($typeI18n)) {
                continue;
            }
            $i++;
            ?>

            <div class="item item<?= $i ?>">
                <?php $typeUrl = ($type->getId() == 5) ?  BuildingController::getRebuildingUrl() :  BuildingController::getTypeUrl($type) ?>
                <a href="<?= $typeUrl?>">
                    <div class="visual">
                        <img
                            src="<?= $i < 3 ? $type->getWidePreviewPath() : $type->getPreviewPath() ?>"
                            alt="<?= Html::encode($typeI18n->getName()) ?>"
                        />
                    </div>
					<span class="text">
						<h3><?= Html::encode($typeI18n->getName()) ?></h3>
					</span>
                </a>
            </div>

        <?php endforeach;?>

    </div>
</div>