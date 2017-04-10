<?php

use app\widgets\MyModal;

/**
 * Модалка для запроса скидки
 * @var app\components\View $this
 */

$applicationModal = new MyModal();
$applicationModal->id = 'discount-modal';
$applicationModal->content = $this->render('_discountContent');
echo $applicationModal->run();