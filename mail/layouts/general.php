<?php

use yii\helpers\Html;

/**
 * Общий layout для писем
 *
 * @var yii\web\View $this
 * @var yii\mail\MessageInterface $message
 * @var string $content
 */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= Html::encode($message->getSubject()) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php
    $this->beginBody();
    echo $content;
    $this->endBody();
    ?>
</body>
</html>
<?php $this->endPage() ?>
