<?php

use yii\helpers\Html;
use app\models\Language;

/**
 * @var app\components\View $this
 * @var \app\models\Language $language
 * @var \app\models\OfficeRegion[] $regions
 */

\app\assets\Map::register($this);

$mapsLangs = [
    Language::ID_RU => 'ru_RU',
    Language::ID_EN => 'en_US',
];
$mapLang = isset($mapsLangs[$language->getId()]) ? $mapsLangs[$language->getId()] : $mapsLangs[Language::ID_EN];
?>

<script src="http://api-maps.yandex.ru/2.1/?lang=<?= $mapLang ?>"></script>

<div class="tab-map">
    <div class="tabset-holder">
        <ul class="tabset">
            <?php foreach($regions as $i => $region):
                /** @var \app\models\OfficeRegionI18n|null $regionI18n */
                $regionI18n = $region->getI18n($language);
                if(empty($regionI18n)) {
                    continue;
                }
                ?>

                <li class="<?= $i == 0 ? 'active' : '' ?>">
                    <a href="#"><?= Html::encode($regionI18n->getName()) ?></a>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>

    <div class="tab-body">

        <?php foreach($regions as $i => $region):
            /** @var \app\models\OfficeRegionI18n|null $regionI18n */
            $regionI18n = $region->getI18n($language);
            if(empty($regionI18n)) {
                continue;
            }
            ?>

            <div class="tab <?= $i == 0 ? 'active' : '' ?>">
                <div class="map">
                    <div class="frame"></div>

                    <div class="addresses" style="display: none">
                        <?php foreach($region->getOffices() as $k => $office):
                            /** @var \app\models\OfficeI18n|null $officeI18n */
                            $officeI18n = $office->getI18n($language);
                            if(empty($officeI18n)) {
                                continue;
                            }
                            $phone = $office->getPhone();
                            $phoneComment = $officeI18n->getPhoneComment();
                            $email = $officeI18n->getEmail();
                            $comment = $officeI18n->getComment();
                            ?>

                            <div
                                class="adr"
                                data-lat="<?= $office->getCoordsLat() ?>"
                                data-lng="<?= $office->getCoordsLng() ?>"
                            >

                                <div class="holder">
                                    <header class="head">
                                        <h3><?= Html::encode($officeI18n->getName()) ?></h3>
                                    </header>
                                    <address><?= Html::encode($officeI18n->getAddress()) ?></address>
                                    <a href="tel:<?= Html::encode($phone) ?>" class="tel"><?= Html::encode($phone) ?></a>

                                    <?php if(!empty($phoneComment)): ?>
                                        <span class="text"><?= Html::encode($phoneComment) ?></span>
                                    <?php endif; ?>

                                    <a href="mailto:<?= Html::encode($email) ?>" class="mail"><?= Html::encode($email) ?></a>

                                    <?php if(!empty($comment)): ?>
                                        <div class="time-work">
                                            <?= $comment ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>