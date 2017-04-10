<?php

use app\widgets\MyModal;
use yii\helpers\Html;

/**
 * Обслуживание бассейнов
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Service $service
 * @var \app\models\ServiceI18n $serviceI18n
 * @var \app\models\ServiceAdvantage $advantages
 */

\app\assets\Maintenance::register($this);

$this->setTitle($serviceI18n->getPageTitle());
$this->setMetaKeywords($serviceI18n->getPageMetaKeywords());
$this->setMetaDescription($serviceI18n->getPageMetaDescription());

$modal = new MyModal();
$modal->id = 'maintenance-modal';
$modal->content = $this->render('maintenance/_maintenanceModal');
echo $modal->run();
?>

<div class="service-pool">
    <div class="center">
        <div class="visual">
            <img src="<?= $this->getPublishedFileUrl('images/bg1-1.png') ?>" />
        </div>
        <header class="main-head">
            <h4><?= Html::encode($serviceI18n->getName()) ?></h4>
        </header>
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
        <a href="#" class="btn btn-order-cat"><?= Yii::t('app', 'request the service') ?></a>
    </div>
</div>

