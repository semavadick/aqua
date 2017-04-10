<?php

use yii\helpers\Html;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\Publication $publication
 */

/** @var \app\models\PublicationI18n|null $publicationI18n */
$publicationI18n = $publication->getI18n($language);
if(empty($publicationI18n)) {
    return;
}

$description = $publicationI18n->getDescription();
$galleries = $publication->getGalleries();
$galleryPattern = '/\\[\\[~GALLERY~\\]\\]/';
$actionPattern = '/\\[\\[~BUTTON~\\]\\]/';
while(preg_match($galleryPattern, $description)) {
    if(!empty($galleries)) {
        $gallery = array_shift($galleries);
        $renderedGallery = $this->render('_publicationGallery', [
            'language' => $language,
            'gallery' => $gallery,
        ]);
    } else {
        $renderedGallery = '';
    }
    $description = preg_replace($galleryPattern, $renderedGallery, $description, 1);
}
if (preg_match($actionPattern, $description)) $description = preg_replace($actionPattern, '<a class="btn send-application" href="#">свяжитесь с нами</a>', $description, 1);
?>

<article class="article">
    <h2><?= Html::encode($publicationI18n->getShortDescription()) ?></h2>
    <div class="box">
        <?= $description ?>
    </div>
</article>