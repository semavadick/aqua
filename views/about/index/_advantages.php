<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AboutPage $page
 * @var \app\models\AboutPageI18n $pageI18n
 * @var \app\models\Advantage[] $advantages
 */

if(empty($advantages)) {
    return;
}
?>

<div class="advantages-main" id="advantages">
    <div class="advantages">
        <div class="center">
            <header class="main-head">
                <h2><?= Yii::t('app', 'OUR ADVANTAGES:') ?></h2>
            </header>
            <ul class="list">
                <?php foreach($advantages as $advantage):
                    /** @var \app\models\AdvantageI18n|null $advantageI18n */
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
                                <span><?= $advantageI18n->getText() ?></span>
                            </div>
                        </div>
                    </li>

                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>