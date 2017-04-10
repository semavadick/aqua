<?php

use yii\helpers\Html;
use app\controllers\NewsController;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\News[] $news
 */

if(empty($news)) {
    return;
}
?>
<div class="bottom-news-box" id="news">
    <div class="center">
        <header class="main-head">
            <h2><?= Yii::t('app', 'Company news') ?></h2>
        </header>
        <ul class="bottom-news">
            <?php foreach($news as $newsItem):
                /** @var \app\models\NewsI18n|null $newsItemI18n */
                $newsItemI18n = $newsItem->getI18n($language);
                if(empty($newsItemI18n)) {
                    continue;
                }
                ?>

                <li>
                    <a href="<?= NewsController::getNewsItemUrl($newsItem) ?>">
                        <div class="visual">
                            <img src="<?= Html::encode($newsItem->getPreviewPath()) ?>" alt="<?= Html::encode($newsItemI18n->getName()) ?>">
                        </div>
                        <div class="text">
                            <header class="head">
                                <span class="date"><?= $newsItem->getFormattedDate() ?></span>
                                <h3><?= Html::encode($newsItemI18n->getName()) ?></h3>
                            </header>
                            <p><?= Html::encode($newsItemI18n->getShortDescription()) ?></p>
                        </div>
                    </a>
                </li>

            <?php endforeach;?>
        </ul>
    </div>
</div>