<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\controllers\PublicationsController $controller
 * @var \app\models\Language $language
 * @var \app\models\Publication|null $publication
 */

if(empty($publication)) {
    return;
}
/** @var \app\models\PublicationI18n|null $publicationI18n */
$publicationI18n = $publication->getI18n($language);
if(empty($publicationI18n)) {
    return;
}
$category = $publication->getCategory();
/** @var \app\models\CategoryI18n|null $categoryI18n */
$categoryI18n = !empty($category) ? $category->getI18n($language) : null;
?>

<div class="gallery-main-holder">
    <ul class="knowledge-base-gallery">
        <li class="flex-image-holder">
            <a href="<?= $controller->getPublicationUrl($publication) ?>">
				<span class="visual">
					<img class="flex-image" src="<?= $publication->getBgPath() ?>" alt="<?= Html::encode($publicationI18n->getName()) ?>" />
				</span>

                <div class="center">
                    <div class="text-holder">
                        <div class="cell">
                            <header class="head-title">
                                <span class="date <?= empty($categoryI18n) ? 'no-category' : ''?>"><?= $publication->getFormattedDate() ?></span>

                                <?php if(!empty($categoryI18n)): ?>
                                    <span class="title"><?= Html::encode($categoryI18n->getName()) ?></span>
                                <?php endif; ?>

                            </header>
                            <h1><?= Html::encode($publicationI18n->getName()) ?></h1>
                        </div>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</div>
