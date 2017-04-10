<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\MainPageSlide[] $slides
 */

if(empty($slides)) {
    return;
}
?>

<div class="gallery-main-holder">
    <ul class="gallery-main">

        <?php foreach($slides as $slide):
            /** @var \app\models\MainPageSlideI18n|null $slideI8n */
            $slideI8n = $slide->getI18n($language);
            if(empty($slideI8n)) {
                continue;
            }
            ?>

            <li class="flex-image-holder">
                <a href="<?= $slideI8n->getLink() ?>">
					<span class="visual">
						<img class="flex-image" src="<?= $slide->getImagePath() ?>" alt="<?= Html::encode($slideI8n->getText()) ?>">
					</span>
                    <div class="center">
                        <div class="text-holder">
                            <div class="cell">
                                <h1><?= $slideI8n->getText() ?></h1>
                            </div>
                        </div>
                    </div>
                </a>
            </li>

        <?php endforeach;?>

    </ul>
</div>