<?php
/**
 * @var \app\components\View $this
 */

$modal = new \app\widgets\MyModal();
$modal->id = 'help-modal';
$modal->content = $this->render('_helpModalContent');
echo $modal->run();
?>

<div class="order-block-help">
    <div class="center">
        <span><?= Yii::t('app', 'not sure what to choose?') ?></span>
        <a href="#" class="btn btn-help"><?= Yii::t('app', 'let us help you') ?></a>
    </div>
</div>


