<?php

use yii\helpers\Html;
use app\widgets\MyModal;

/**
 * Тип бассейна
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PoolType $type
 * @var \app\models\PoolTypeI18n $typeI18n
 * @var \app\models\ObjectGallery[] $galleries
 * @var \app\models\TypeAdvantage[] $advantages
 * @var \app\models\ObjectGallery[] $galleries
 * @var \app\models\TypeAdvantage[] $advantages
 */

$this->setTitle($typeI18n->getPageTitle());
$this->setMetaKeywords($typeI18n->getPageMetaKeywords());
$this->setMetaDescription($typeI18n->getPageMetaDescription());
?>


<div class="building-steps">
    <div class="center-head">
        <h3><?= Html::encode($typeI18n->getName()) ?></h3>
        <div class="head" style="background-image: url(<?= $type->getBgPath() ?>)">
        </div>
    </div>

    <?= (string) $additionCategoriesBlock;?>

    <?= $this->render('general/_galleries', [
        'header' => Yii::t('app', 'GALLERY OF REALIZED OBJECTS'),
        'language' => $language,
        'galleries' => $galleries,
    ]) ?>

    <div class="order-block">
        <div class="center">
            <a href="#" class="btn btn-calc"><?= Yii::t('app', 'request calculation') ?></a>
        </div>
    </div>

    <div class="center">
        <div class="list-adv">

            <h2><?= Yii::t('app', 'Key advantages:') ?></h2>

            <?php if(!empty($advantages)): ?>
                <ul class="building-steps-list">

                    <?php foreach($advantages as $advantage):
                        /** @var \app\models\TypeAdvantageI18n|null $advantageI18n */
                        $advantageI18n = $advantage->getI18n($language);
                        if(empty($advantageI18n)) {
                            continue;
                        }
                        ?>

                        <li>
                            <i class="ico1">
                                <img src="<?= $advantage->getIconUrl() ?>" />
                            </i>
                            <h3><?= $advantageI18n->getText() ?></h3>
                        </li>

                    <?php endforeach; ?>

                </ul>
            <?php endif; ?>

            <?php if($typeI18n->getStagesPath()): ?>
                <a href="<?= $typeI18n->getStagesPath() ?>" target="_blank" class="btn">
                    <?= Yii::t('app', 'download building stages') ?><i class="ico"></i>
                </a>
            <?php endif; ?>

        </div>

        <div class="text">
            <?= $typeI18n->getDescription() ?>
        </div>

    </div>
</div>


<?= $this->render('/services/general/_calcModal', [
    'language' => $language,
]) ?>