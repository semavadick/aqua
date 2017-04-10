<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\AboutPage $page
 * @var \app\models\AboutPageI18n $pageI18n
 * @var \app\models\Certificate[] $certificates
 */

if(empty($certificates)) {
    return;
}
?>

<div class="sert" id="certificates">
    <div class="center">
        <header class="main-head">
            <h2><?= Yii::t('app', 'CERTIFICATES AND PATENTS') ?></h2>
        </header>
        <ul class="gallery">
            <?php foreach($certificates as $certificate):
                /** @var \app\models\CertificateI18n|null $certificateI18n */
                $certificateI18n = $certificate->getI18n($language);
                if(empty($certificateI18n)) {
                    continue;
                }
                ?>

                <li>
                    <a rel="group1" href="<?= $certificate->getImageUrl() ?>" class="fancy">
                        <img src="<?= $certificate->getPreviewUrl() ?>" height="362" width="258" alt="<?= Html::encode($certificateI18n->getName()) ?>">
                    </a>
                </li>

            <?php endforeach;?>
        </ul>
    </div>
</div>