<?php

namespace back\controllers;

use yii\web\Response;

/**
 * Базовый класс модулей админки
 */
abstract class ModuleController extends Controller {

    /** @inheritdoc */
    public function beforeAction($action) {
        if(!parent::beforeAction($action)) {
            return false;
        }
        if($this->getWebUser()->getIsGuest()) {
            $resp = \Yii::$app->getResponse();
            $resp->content = 'Войдите в панель управления';
            $resp->format = Response::FORMAT_RAW;
            $resp->setStatusCode(401);
            return false;
        }
        if(!$this->checkAccess()) {
            $resp = \Yii::$app->getResponse();
            $resp->content = 'Запрещено';
            $resp->format = Response::FORMAT_RAW;
            $resp->setStatusCode(403);
            return false;
        }
        return true;
    }

    /** @return boolean */
    protected function checkAccess() {
        return true;
    }

}