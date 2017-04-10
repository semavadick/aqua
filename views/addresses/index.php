<?php
/**
 * Адреса на карте
 *
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\OfficeRegion[] $regions
 */

$title = Yii::t('app', 'Addresses on the map');
$this->setTitle($title);
$this->setMetaKeywords($title);
$this->setMetaDescription($title);

echo $this->render('_map', [
    'language' => $language,
    'regions' => $regions,
]);