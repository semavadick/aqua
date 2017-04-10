<?php

namespace app\controllers;

use app\models\AboutPage;
use app\models\AboutPageI18n;
use app\repositories\AdvantagesRepository;
use app\repositories\HistoryStagesRepository;
use app\repositories\NewsRepository;
use app\repositories\OfficeRegionsRepository;
use app\repositories\ProductionBannersRepository;
use app\repositories\ProductionImagesRepository;
use app\repositories\CertificatesRepository;

class AboutController extends Controller {

    /**
     * @return string
     */
    public function actionIndex() {
        $language = self::getCurrentLanguage();
        /** @var AboutPage $page */
        $page = $this->getEntityManager()->find('Models:AboutPage', 0);
        /** @var AboutPageI18n $pageI18n */
        $pageI18n = $page->getI18n($language);
        $historyStages = HistoryStagesRepository::getInstance()->findStagesForAboutPage($language);
        $banners = ProductionBannersRepository::getInstance()->findBannersForAboutPage(3, $language);
        $images = ProductionImagesRepository::getInstance()->findImagesForAboutPage(3, $language);
        $advantages = AdvantagesRepository::getInstance()->findAdvantagesForAboutPage($language);
        $certificates = CertificatesRepository::getInstance()->findCertificatesForAboutPage($language);
        $news = NewsRepository::getInstance()->findNewsForAboutPage(2, $language);
        $regions = OfficeRegionsRepository::getInstance()->findRegionsForAboutPage($language);
        return $this->render('index', [
            'language' => $language,
            'page' => $page,
            'pageI18n' => $pageI18n,
            'historyStages' => $historyStages,
            'banners' => $banners,
            'images' => $images,
            'advantages' => $advantages,
            'certificates' => $certificates,
            'news' => $news,
            'regions' => $regions,
        ]);
    }

    /**
     * @param string $anchor
     * @return string
     */
    public static function getIndexUrl($anchor = null) {
        $url = self::getUrlForCurrentLanguage(['about/index']);
        if(!empty($anchor)) {
            $url .= "#{$anchor}";
        }
        return $url;
    }

    /**
     * @return string
     */
    public static function getProductionGalleryUrl() {
        return GalleriesController::getProductionGalleryUrl();
    }

}
