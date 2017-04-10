<?php

namespace back\controllers;

use back\forms\EntityForm;
use yii\web\Response;

/**
 * Базовый класс для контроллеров форм
 */
abstract class FormController extends ModuleController {

    public function actionIndex() {
        $form = $this->getForm();
        switch($this->getRequestMethod()) {
            case 'GET':
            default:
                return $this->actionIndexGET($form);
                break;

            case 'PUT':
                return $this->actionIndexPOST($form);
                break;
        }

    }

    public function actionIndexGET(EntityForm $form) {
        return $this->getResponse($form->getData());
    }

    public function actionIndexPOST(EntityForm $form) {
        $form->load($this->getRequestBodyJSON());
        if($form->save()) {
            return $this->getResponse('ok', Response::FORMAT_RAW);
        }
        return $this->getResponse($form->getErrors(), Response::FORMAT_JSON, 400);
    }

    /** @return EntityForm */
    protected abstract function getForm();

}