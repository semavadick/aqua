<?php

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 */

\app\assets\Calc::register($this);

$modal = new \app\widgets\MyModal();
$modal->setId('calc-modal');
$modal->content = $this->render('_calcModalContent', [
    'language' => $language,
]);
echo $modal->run();