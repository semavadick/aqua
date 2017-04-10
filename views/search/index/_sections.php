<?php

use app\forms\SearchForm;
use app\controllers\SearchController;

/**
 * @var \app\components\View $this
 * @var string $query
 * @var int $section
 * @var int[] $resultsCount
 */

$items = [
    SearchForm::SECTION_STORE => Yii::t('app', 'store'),
    SearchForm::SECTION_ARTICLES => Yii::t('app', 'knowledge base'),
    SearchForm::SECTION_NEWS => Yii::t('app', 'news'),
    SearchForm::SECTION_BUILDING => Yii::t('app', 'pools building'),
    SearchForm::SECTION_SERVICES => Yii::t('app', 'services'),
    SearchForm::SECTION_ABOUT => Yii::t('app', 'about'),
];
?>

<?php foreach($items as $itemSection => $itemText):
    if(empty($resultsCount[$itemSection])) {
        continue;
    }
    ?>

    <a
        class="s-section <?= $section == $itemSection ? 's-section--active' : '' ?>"
        href="<?= SearchController::getIndexUrl($query, $itemSection) ?>"
    >
        <?= $itemText ?>
        <span class="s-section__count"><?= $resultsCount[$itemSection] ?></span>
    </a>
    <br/>


<?php endforeach; ?>