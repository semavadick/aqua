<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AboutPage $page
 * @var \app\models\AboutPageI18n $pageI18n
 * @var \app\models\HistoryStage[] $historyStages
 */
?>

<div class="content-menu-cover" id="history">
    <div class="content-menu">
        <div class="content-menu__img" style="background-image: url(<?= $pageI18n->getHistoryImageUrl() ?>)"></div>
        <div class="menu-wrap has-scroll">
            <div class="menu-cover">
                <ul class="menu-elements">

                    <?php foreach($historyStages as $stage):
                        /** @var \app\models\HistoryStageI18n|null $stageI18n */
                        $stageI18n = $stage->getI18n($language);
                        if(empty($stageI18n)) {
                            continue;
                        }
                        ?>

                        <li>
                            <a>
                                <span class="year"><?= $stage->getYear() ?></span>
								<span class="visual">
									<img src="<?= $stage->getImagePath() ?>" />
								</span>
                                <?= $stageI18n->getText() ?>
                            </a>
                        </li>

                    <?php endforeach;?>

                </ul>
            </div>
        </div>
    </div>
</div>