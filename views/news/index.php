<?php
/**
 * Новости
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\News|null $topNewsItem
 * @var \app\models\News[] $news
 * @var \yii\data\Pagination $pagination
 */

\app\assets\Articles::register($this);

$title = Yii::t('app', 'News');
$this->setTitle($title);
$this->setMetaKeywords($title);
$this->setMetaDescription($title);
?>

<?= $this->render('/publications/_topPublication', [
    'controller' => $this->context,
    'language' => $language,
    'publication' => $topNewsItem,
]) ?>

<div class="center">
    <div class="knowledge-base">

        <div class="content">
            <?= $this->render('/publications/_publicationsGrid', [
                'controller' => $this->context,
                'language' => $language,
                'publications' => $news,
                'pagination' => $pagination,
            ]) ?>
        </div>

    </div>

</div>
