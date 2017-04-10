<?php
/**
 * Поиск
 * @var \app\components\View $this
 * @var \app\models\Language $language
 * @var \app\forms\SearchForm $form
 * @var \app\forms\SearchResult[] $results
 * @var int $resultsCount
 * @var \app\models\Article[] $articles
 */

$title = Yii::t('app', 'Search results');
$this->setTitle($title);
$this->setMetaKeywords($title);
$this->setMetaDescription($title);
?>

<div class="center">

    <div class="s-results">

        <div class="s-results__form">
            <?= $this->render('index/_form', [
                'model' => $form,
            ]) ?>
        </div>

        <div class="s-results__content">

            <?php if(!empty($results)): ?>

                <div class="s-results__sections">
                    <?= $this->render('index/_sections', [
                        'query' => $form->query,
                        'section' => $form->section,
                        'resultsCount' => $resultsCount,
                    ]) ?>
                </div>

                <div class="s-results__list">
                    <?= $this->render('index/_results', [
                        'results' => $results,
                    ]) ?>
                </div>

            <?php else: ?>

                    <h1 class="not-found"><?= Yii::t('app', 'Nothing found') ?></h1>

            <?php endif; ?>
        </div>

    </div>

    <?= $this->render('/site/index/_articles', [
        'language' => $language,
        'articles' => $articles,
    ]) ?>
</div>