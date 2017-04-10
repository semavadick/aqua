<?php

use app\widgets\MyModal;
use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\MainPage $page
 * @var \app\models\MainPageI18n $pageI18n
 */

$catalogModal = new MyModal();
$catalogModal->id = 'catalog-modal';
$catalogModal->content = $this->render('_catalogModal');
echo $catalogModal->run();
?>

<div class="order-catalog">
    <div class="visual">
        <img src="<?= $pageI18n->getCatalogImagePath() ?>">
    </div>
    <a href="#" class="btn"><?= Yii::t('app', 'request a free catalogue') ?></a>
</div>