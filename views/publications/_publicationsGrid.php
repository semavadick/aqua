<?php

use yii\helpers\Html;
use app\controllers\StoreController;

/**
 * @var app\components\View $this
 * @var \app\controllers\PublicationsController $controller
 * @var \app\models\Language $language
 * @var \app\models\Publication[] $publications
 * @var \yii\data\Pagination $pagination
 */
?>

<ul class="knowledge-base-list">
    <?php foreach($publications as $publication):
        /** @var \app\models\PublicationI18n|null $publicationI18n */
        $publicationI18n = $publication->getI18n($language);
        if(empty($publicationI18n)) {
            return;
        }
        $category = $publication->getCategory();
        /** @var \app\models\CategoryI18n|null $categoryI18n */
        $categoryI18n = !empty($category) ? $category->getI18n($language) : null;
        ?>

        <li>
            <a href="<?= $controller->getPublicationUrl($publication)?>">
                <div class="visual">
                    <img src="<?= $publication->getPreviewPath() ?>" alt="<?= Html::encode($publicationI18n->getName()) ?>">
                </div>
                <header class="head">
                    <span class="date"><?= $publication->getFormattedDate() ?></span>
                    <h2><?= Html::encode($publicationI18n->getName()) ?></h2>
                </header>
                <p><?= Html::encode($publicationI18n->getShortDescription()) ?></p>
            </a>

            <?php if(!empty($categoryI18n)): ?>
                <a href="<?= StoreController::getStoreUrl($category) ?>" class="title-cathegory"><?= Html::encode($categoryI18n->getName()) ?></a>
            <?php endif; ?>
        </li>

    <?php endforeach; ?>
</ul>

<?= $this->render('/general/_ajaxPagination', [
    'pagination' => $pagination,
    'containers' => [
        [
            'selector' => '.knowledge-base-list',
            'itemsSelector' => '.knowledge-base-list li',
        ],
    ],
]); ?>