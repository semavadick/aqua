<?php
use yii\helpers\Html;

/**
 * Главный layout
 *
 * @var back\components\View $this
 * @var string $content
 */

$this->beginContent('@back/views/layouts/general.php');
echo $this->render('_leftMenu');
?>
    <div class="wrap">
        <section class="wrapper scrollable">
            <?php
            echo $this->render('_userMenu');
            echo $this->render('_breadcrumbs');
            echo $content;
            ?>
        </section>
    </div>
<?php $this->endContent(); ?>