<?php

namespace back\controllers;

use app\components\Doctrine;
use Doctrine\ORM\EntityManager;
use Yii;
use yii\web\Response;

/**
 * Базовый класс для всех контроллеров в админке
 */
abstract class Controller extends \yii\base\Controller {

    /**
     * @return \app\components\WebUser Инстанс объекта посетителя
     */
    protected function getWebUser() {
        return Yii::$app->getUser();
    }

    protected function getResponse($data, $format = Response::FORMAT_JSON, $statsCode = 200) {
        $response = \Yii::$app->getResponse();
        $response->format = $format;
        $response->setStatusCode($statsCode);
        $response->data = $data;
        return $response;
    }

    protected function getRequestMethod() {
        return \Yii::$app->getRequest()->getMethod();
    }

    /** @return array */
    protected function getRequestBodyJSON() {
        return $data = json_decode(\Yii::$app->getRequest()->getRawBody(), true);
    }

    /** @return EntityManager */
    protected function getEntityManager() {
        /** @var Doctrine $doctrine */
        $doctrine = Yii::$app->get('doctrine');
        return $doctrine->getEntityManager();
    }

} 