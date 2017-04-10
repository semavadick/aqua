<?php

/**
 * @var app\components\View $this
 */

$modal = new \app\widgets\MyModal();
$modal->setId('popup-basket');
$modal->content = $this->render('_cartModalContent');
echo $modal->run();
?>

<a class="basket-btn" id="cart-btn" href="#">
    <div class="basket">
        <span class="num"></span>
    </div>
</a>