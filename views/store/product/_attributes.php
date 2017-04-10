<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Product $product
 * @var \app\models\ProductI18n $productI18n
 */

$attributes = $product->getAttributes();
if(empty($attributes)) {
    return;
}
?>

<dl>

    <?php foreach($attributes as $attribute):
        /** @var \app\models\ProductAttributeI18n|null $attributeI18n */
        $attributeI18n = $attribute->getI18n($language);
        if(empty($attributeI18n)) {
            continue;
        }
        ?>

        <div class="row">
            <dt><span><?= Html::encode($attributeI18n->getName()) ?></span></dt>
            <dd><?= Html::encode($attributeI18n->getValue()) ?></dd>
        </div>

    <?php endforeach; ?>

</dl>