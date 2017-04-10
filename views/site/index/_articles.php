<?php

use yii\helpers\Html;
use app\controllers\ArticlesController;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Article[] $articles
 */

if(empty($articles)) {
    return;
}
?>

<div class="bottom-news-box">
    <header class="main-head">
        <h2><?= Yii::t('app', 'SHARING EXPERIENCE') ?></h2>
    </header>
    <ul class="bottom-news">

        <?php foreach($articles as $article):
            /** @var \app\models\ArticleI18n|null $articleI18n */
            $articleI18n = $article->getI18n($language);
            if(empty($articleI18n)) {
                continue;
            }
            ?>

            <li>
                <a href="<?= ArticlesController::getArticleUrl($article) ?>">
                    <div class="visual">
                        <img src="<?= Html::encode($article->getPreviewPath()) ?>" alt="<?= Html::encode($articleI18n->getName()) ?>">
                    </div>
                    <div class="text">
                        <header class="head">
                            <span class="date"><?= $article->getFormattedDate() ?></span>
                            <h3><?= Html::encode($articleI18n->getName()) ?></h3>
                        </header>
                        <p><?= Html::encode($articleI18n->getShortDescription()) ?></p>
                    </div>
                </a>
            </li>

        <?php endforeach;?>

    </ul>
</div>