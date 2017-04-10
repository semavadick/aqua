<?php

use yii\helpers\Html;

/**
 * Галерея объекта
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AboutPage $page
 * @var \app\models\AboutPageI18n $pageI18n
 * @var \app\models\ProductionImage[] $images
 * @var \app\models\PoolType[] $types
 */

\app\assets\Galleries::register($this);

$this->setTitle(Yii::t('app', 'Manufacturing image gallery'));
?>

<div class="gallery-tabs">

    <?= $this->render('general/_types', [
        'language' => $language,
        'isManufacturing' => true,
        'types' => $types,
    ]) ?>

    <div class="tab-body">
        <div class="tab active">
            <div class="descr">

                <h3><?= Html::encode($pageI18n->getProductionTitle()) ?></h3>
                <?= $pageI18n->getProductionText() ?>

                <a href="#" class="btn btn-calc"><?= Yii::t('app', 'request calculation') ?></a>

            </div>

            <div class="gallery-holder">
                <ul class="gallery">

                    <?php foreach($images as $image):
                        /** @var \app\models\ProductionImageI18n|null $imageI18n */
                        $imageI18n = $image->getI18n($language);
                        if(empty($imageI18n)) {
                            continue;
                        }
                        ?>

                        <li>
                            <img src="<?= $image->getImageUrl() ?>" alt="<?= Html::encode($imageI18n->getText()) ?>" />
                        </li>

                    <?php endforeach; ?>

                </ul>
            </div>

        </div>
    </div>
</div>

<?= $this->render('/services/general/_calcModal', [
    'language' => $language,
]) ?>
