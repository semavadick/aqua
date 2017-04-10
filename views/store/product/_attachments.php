<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Product $product
 * @var \app\models\ProductI18n $productI18n
 */

$attachments = $product->getAttachments();
$count = 0;
foreach($attachments as $attachment) {
    $attachmentI18n = $attachment->getI18n($language);
    if(!empty($attachmentI18n)) {
        $count++;
    }
}
if($count == 0) {
    return;
}
?>

<div class="info-box">

    <?php if($count > 1): ?>

        <ul>
            <?php foreach($attachments as $attachment):
                /** @var \app\models\AttachmentI18n|null $attachmentI18n */
                $attachmentI18n = $attachment->getI18n($language);
                if(empty($attachmentI18n)) {
                    continue;
                }
                ?>

                <li>
                    <i class="ico">
                        <img src="<?= $attachment->getIconPath() ?>" />
                    </i>
                    <span><?= Html::encode($attachmentI18n->getText()) ?></span>
                </li>

            <?php endforeach; ?>
        </ul>

    <?php else:
        /** @var \app\models\Attachment $attachment */
        $attachment = array_values($attachments)[0];
        /** @var \app\models\AttachmentI18n|null $attachmentI18n */
        $attachmentI18n = $attachment->getI18n($language);
        ?>

        <i class="ico">
            <img src="<?= $attachment->getIconPath() ?>" />
        </i>
        <div class="table">
            <span><?= Html::encode($attachmentI18n->getText()) ?></span>
        </div>

    <?php endif; ?>
</div>