<?php
/**
 * Layout сайта для страниц
 *
 * @var app\components\View $this
 * @var string $content
 */

$this->beginContent('@app/views/layouts/general.php');
?>

    <div id="wrapper">
        <?= $this->render('_header') ?>

        <main id="main">
            <?= $content ?>
        </main>
    </div>
    <?= $this->render('_footer') ?>
<?php $this->endContent(); ?>