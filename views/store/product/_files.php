<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Product $product
 * @var \app\models\ProductI18n $productI18n
 */
?>

<div class="list-holder">
    <ul class="list">

        <?php if($product->hasFigure()):
            $modal = new \app\widgets\MyModal();
            $modal->setId('figure-modal');
            $modal->noPadding = true;
            $modal->content = '<div class="sketchfab-embed-wrapper"><iframe width="640" height="480" src="'.$product->getFigure().'/embed" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" onmousewheel=""></iframe>
</div>';
            ?>

            <li>
                <?= $modal->run() ?>
                <a href="#" class="btn-figure">
                    <div class="visual">
                        <img src="<?= $this->getPublishedFileUrl('images/img7.png') ?>" height="45" width="49" />
                    </div>
                    <p><?= Yii::t('app', '3D-model') ?></p>
                </a>
            </li>

        <?php endif; ?>




        <?php if($product->hasDraft()):
            $modal = new \app\widgets\MyModal();
            $modal->setId('draft-modal');
            $modal->noPadding = true;
            $modal->content = '<img src="'.$product->getDraftPath().'" style="max-width: 80%;" />';
        ?>

            <li>
                <?= $modal->run() ?>
                <a href="#" class="btn-draft">
                    <div class="visual">
                        <img src="<?= $this->getPublishedFileUrl('images/img8.png') ?>" height="48" width="48" />
                    </div>
                    <p><?= Yii::t('app', 'Draft') ?></p>
                </a>
            </li>

        <?php endif; ?>




        <?php if($product->hasCircuit()):
            $modal = new \app\widgets\MyModal();
            $modal->setId('circuit-modal');
            $modal->noPadding = true;
            $modal->content = '<img src="'.$product->getCircuitPath().'" style="max-width: 80%;" />';
        ?>
            <li>
                <?= $modal->run() ?>
                <a href="#" class="btn-circuit">
                    <div class="visual">
                        <img src="<?= $this->getPublishedFileUrl('images/img9.png') ?>" height="48" width="48" />
                    </div>
                    <p><?= Yii::t('app', 'Circuit') ?></p>
                </a>
            </li>

        <?php endif; ?>




        <?php if($product->hasCertificate()): ?>

            <li>
                <a href="<?= $product->getCertificatePath() ?>" target="_blank">
                    <div class="visual">
                        <img src="<?= $this->getPublishedFileUrl('images/img10.png') ?>" height="48" width="48" />
                    </div>
                    <p><?= Yii::t('app', 'Certificate') ?></p>
                </a>
            </li>

        <?php endif; ?>

    </ul>
</div>