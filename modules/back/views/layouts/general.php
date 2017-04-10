<?php
use back\assets;
use yii\helpers\Html;

/**
 * Общий layout админки
 *
 * @var back\components\View $this
 * @var string $content
 */

assets\General::register($this);
$frontendPath = (new assets\General())->sourcePath;
$frontendUrl = $this->getAssetManager()->getPublishedUrl($frontendPath);
$this->beginPage();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7 lt-ie10"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8 lt-ie10"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?= "$frontendUrl/favicon.ico" ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->getTitle()) ?></title>
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
