<?php

namespace app\controllers;

use app\repositories\OfficeRegionsRepository;

class AddressesController extends Controller {

    /**
     * @return string
     */
    public function actionIndex() {
        $language = self::getCurrentLanguage();
        $regions = OfficeRegionsRepository::getInstance()->findRegionsForAboutPage($language);
        return $this->render('index', [
            'language' => $language,
            'regions' => $regions,
        ]);
    }

    /**
     * @return string
     */
    public static function getIndexUrl() {
        return self::getUrlForCurrentLanguage(['addresses/index']);
    }

}