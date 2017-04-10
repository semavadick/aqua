<?php

use yii\helpers\Html;
use app\controllers\BuildingController;
/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PoolsBuildingPage $page
 * @var \app\models\PoolsBuildingPageI18n $pageI18n
 * @var \app\models\Advantage[] $advantages
 */

if(empty($advantages)) {
    return;
}
?>

<div class="advantages-tech" id="techs">
    <div class="center">
        <header class="main-head">
            <h3><?= Yii::t('app', 'tech advantages') ?></h3>
        </header>
        <ul class="gallery">

            <?php foreach($advantages as $advantage):
                /** @var \app\models\TechAdvantageI18n|null $advantageI18n */
                $advantageI18n = $advantage->getI18n($language);
                if(empty($advantageI18n)) {
                    continue;
                }
                $tagline = Html::encode($advantageI18n->getTagline());
                ?>

                <li>
                    <div class="title">
                        <i class="ico">
                            <img src="<?= $advantage->getIconUrl() ?>" alt="<?= $tagline ?>">
                        </i>
                        <h3><?= $tagline ?></h3>
                    </div>
                    <div class="text">
                        <?= $advantageI18n->getText() ?>
                        <div class="btn-holder">
                            <span><?= Yii::t('app', 'Do you have any questions?') ?></span>
                            <a href="#" class="btn question-btn"><?= Yii::t('app', 'contact us') ?></a>
                        </div>
                    </div>
                </li>

            <?php endforeach;?>

        </ul>
    </div>
</div>