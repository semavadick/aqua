<?php

use yii\helpers\Html;

/**
 * Виджет модального окна
 *
 * @var app\components\View $this
 * @var string $id
 * @var string $content
 * @var boolean $noPadding
 */
?>

<div class="my-modal <?= $noPadding ? 'my-modal--no-padding' : '' ?>" id="<?= Html::encode($id) ?>">
    <div class="my-modal__inner">
        <a class="my-modal__close" href="#"></a>
        <div class="my-modal__content">
            <?= $content ?>
        </div>
    </div>
</div>
