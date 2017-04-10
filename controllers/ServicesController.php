<?php

namespace app\controllers;

use app\forms\CalcForm;
use app\forms\MaintenanceRequestForm;
use app\forms\ServiceTypeForm;
use app\models\ServiceType;
use app\repositories\ObjectGalleriesRepository;
use app\repositories\ProductionImagesRepository;
use app\repositories\ServicesRepository;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class ServicesController extends Controller {

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionMaintenance() {
        $language = self::getCurrentLanguage();
        $service = ServicesRepository::getInstance()->findMaintenanceService();
        $serviceI18n = $service->getI18n($language);
        if(empty($serviceI18n)) {
            throw new NotFoundHttpException();
        }
        $advantages = $service->getAdvantages();
        return $this->render('maintenance', [
            'language' => $language,
            'service' => $service,
            'serviceI18n' => $serviceI18n,
            'advantages' => $advantages,
        ]);
    }

    /** @return string */
    public static function getMaintenanceUrl() {
        return self::getUrlForCurrentLanguage(['services/maintenance']);
    }

    /**
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionRequestMaintenance() {
        $form = new MaintenanceRequestForm();
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        if(!$form->sendRequest()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionExclusive() {
        $language = self::getCurrentLanguage();
        $service = ServicesRepository::getInstance()->findExclusiveService();
        $serviceI18n = $service->getI18n($language);
        if(empty($serviceI18n)) {
            throw new NotFoundHttpException();
        }
        $advantages = $service->getAdvantages();
        $galleries = ObjectGalleriesRepository::getInstance()->findExclusiveGalleries($language);
        return $this->render('exclusive', [
            'language' => $language,
            'service' => $service,
            'serviceI18n' => $serviceI18n,
            'advantages' => $advantages,
            'galleries' => $galleries,
            'productionImages' => ProductionImagesRepository::getInstance()->findImagesForAboutPage(6, $language)
        ]);
    }


    /** @return string */
    public static function getExclusiveUrl() {
        return self::getUrlForCurrentLanguage(['services/exclusive']);
    }

    /**
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionRequestExclusiveType() {
        $form = new ServiceTypeForm();
        $postData = \Yii::$app->getRequest()->post();
        if(!$form->load($postData)) {
            throw new BadRequestHttpException(400);
        }
        $form->loadFile($_FILES);
        if(!$form->sendRequest()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

    /**
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionSendCalcRequest() {
        $form = new CalcForm();
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        if(!$form->sendRequest()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

}