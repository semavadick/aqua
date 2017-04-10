<?php

namespace back\controllers;

use back\models\forms\ChangePassword;
use back\models\forms\ForgotPassword;
use back\Module;
use Yii;
use back\models\forms\Login;
use yii\web\Response;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\base\Exception;
use yii\base\UserException;

class FrontendController extends Controller {

    public function actionIndex() {
        $file = Yii::$app->getRequest()->get('file');
        $frontendPath = Yii::getAlias('@back') . '/frontend/dist/';
        $filePath = $frontendPath . $file;
        if(!is_file($filePath)) {
            $filePath = $frontendPath . 'index.html';
        }
        return Yii::$app->getResponse()->sendFile($filePath, null, [
            'inline' => true,
        ]);
    }

} 