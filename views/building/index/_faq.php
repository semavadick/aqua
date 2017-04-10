<?php

use app\widgets\MyModal;
use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\PoolsBuildingPage $page
 * @var \app\models\PoolsBuildingPageI18n $pageI18n
 * @var \app\models\FaqItem[] $faqItems
 */

$modal = new MyModal();
$modal->id = 'question-modal';
$modal->content = $this->render('_questionModal');
echo $modal->run();

if(empty($faqItems)) {
    return;
}

$columnsItems = [[], []];
for($i = 0; $i < count($faqItems); $i += 2) {
    $columnsItems[0][] = $faqItems[$i];
    if(isset($faqItems[$i + 1])) {
        $columnsItems[1][] = $faqItems[$i + 1];
    }
}
?>

<div class="answers" id="faq">
    <div class="center">
        <header class="main-head">
            <h3><?= Yii::t('app', 'Questions and Answers') ?></h3>
        </header>
        <div class="columns">

            <?php foreach($columnsItems as $columnItems): ?>

                <div class="column">
                    <ul>

                        <?php foreach($columnItems as $item):
                            /** @var \app\models\FaqItem $item */
                            $i = 0;
                            /** @var \app\models\FaqItemI18n|null $itemI18n */
                            $itemI18n = $item->getI18n($language);
                            if(empty($itemI18n)) {
                                continue;
                            }
                            ?>

                            <li>
                                <a href="#"><?= Html::encode($itemI18n->getQuestion()) ?></a>
                                <div class="answer">
                                    <?= $itemI18n->getAnswer() ?>
                                </div>
                            </li>

                        <?php endforeach;?>

                    </ul>
                </div>

            <?php endforeach; ?>
        </div>
    </div>

    <div class="order-block">
        <div class="center">
            <a href="#" class="btn question-btn"><?= Yii::t('app', 'ask us a question') ?></a>
        </div>
    </div>
</div>