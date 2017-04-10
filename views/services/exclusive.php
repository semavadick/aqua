<?php

use app\widgets\MyModal;
use yii\helpers\Html;

/**
 * Эксклюзивные решения
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Service $service
 * @var \app\models\ServiceI18n $serviceI18n
 * @var \app\models\ServiceAdvantage $advantages
 * @var \app\models\ObjectGallery $galleries
 */

$this->setTitle($serviceI18n->getPageTitle());
$this->setMetaKeywords($serviceI18n->getPageMetaKeywords());
$this->setMetaDescription($serviceI18n->getPageMetaDescription());

$modal = new MyModal();
$modal->id = 'exclusive-type-modal';
$modal->content = $this->render('exclusive/_exclusiveTypesModal');
echo $modal->run();
?>


<div class="solutions">
    <div class="center">
        <header class="main-head">
            <h4><?= Html::encode($serviceI18n->getName()) ?></h4>
        </header>
    </div>
    <div class="visual" style="background-image: url(<?= $service->getBgPath() ?>)"></div>
    <div class="center">
        <div class="types-container">
            <?php
            $types = $service->getTypes();
            $count = count($types);
            $i = 0;
            foreach($types as $type):?>
            <div class="type <?= ($i == ($count-1)) ? 'last-child' : ''?>">
                <div class="header">
                    <h4><?= Html::encode($type->getI18n($language)->getText()) ?></h4>
                </div>
                <div class="img-wrap">
                    <img src="<?= $type->getImageUrl()?>" alt="<?= Html::encode($type->getI18n($language)->getText()) ?>" />
                </div>
                <div class="hidden-block">
                    <div class="holder">
                        <div class="frame">
                            <div class="header">
                                <h4><?= Html::encode($type->getI18n($language)->getText()) ?></h4>
                            </div>
                            <div class="link">
                                <a class="request-exclusive-type" data-type-title="<?= Html::encode($type->getI18n($language)->getText()) ?>" href="#">
                                    заказать расчет
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; endforeach;?>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="center">
        <div class="right-box">
            <?= $serviceI18n->getAdditDescription() ?>
        </div>
        <div class="text">
            <?= $serviceI18n->getDescription() ?>
        </div>
    </div>
</div>

<?= $this->render('general/_advantages', [
    'language' => $language,
    'advantages' => $advantages,
]) ?>

<div class="order-block">
    <div class="center">
        <a href="#" class="btn btn-calc"><?= Yii::t('app', 'request calculation') ?></a>
    </div>
</div>

<?= $this->render('exclusive/_video', [
    'serviceI18n' => $serviceI18n,
    'language' => $language,
]) ?>

<?= $this->render('/services/general/_calcModal', [
    'language' => $language,
]) ?>

<?= $this->render('exclusive/_galleries', [
    'header' => Yii::t('app', 'MANUFACTURING GALLERY'),
    'language' => $language,
    'images' => $productionImages,
]) ?>