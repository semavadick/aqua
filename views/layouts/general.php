<?php

use yii\helpers\Html;

/**
 * Главный layout сайта
 *
 * @var app\components\View $this
 * @var string $content
 */

app\assets\General::register($this);
$this->beginPage();
?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/favicon.ico" type="image/x-icon" rel="icon">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->getTitle()) ?></title>
        <meta name="keywords" content="<?= Html::encode($this->getMetaKeywords()) ?>">
        <meta name="description" content="<?= Html::encode($this->getMetaDescription()) ?>">
        <!--[if lte IE 8]><script type="text/javascript" src="<?= $this->getPublishedFileUrl('js/ie.js') ?>"></script><!<![endif]-->
        <?php $this->head() ?>
    </head>
    <body>
    <?php
    $this->beginBody();
    echo $content;
    echo $this->render('modals/_discount');
    $this->endBody();
    ?>
    </body>
    </html>
<?php $this->endPage() ?>