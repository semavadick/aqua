<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\ServiceAdvantage[] $advantages
 */

if(empty($advantages)) {
    return;
}
?>

<div class="advantages">
    <div class="center">
        <ul class="list">

            <?php foreach($advantages as $advantage):
                /** @var \app\models\ServiceAdvantageI18n|null $advantageI18n */
                $advantageI18n = $advantage->getI18n($language);
                if(empty($advantageI18n)) {
                    continue;
                }
                ?>

                <li>
                    <div class="table">
                        <div class="cell">
                            <i class="ico">
                                <img src="<?= $advantage->getIconUrl() ?>" />
                            </i>
                            <span><?= Html::encode($advantageI18n->getText()) ?></span>
                        </div>
                    </div>
                </li>

            <?php endforeach;?>

        </ul>
    </div>
</div>