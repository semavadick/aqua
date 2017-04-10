<?php

namespace back\controllers;

use app\models\Language;
use app\repositories\LanguagesRepository;
use back\forms\LoginForm;
use back\forms\PasswordRecoveryForm;
use back\forms\PasswordResetForm;
use Yii;
use yii\base\Model;
use yii\web\Response;

class AuthController extends Controller {

    /**
     * Инициализация юзера
     * @return string
     */
    public function actionUserInit() {
        $wUser = $this->getWebUser();
        $data = [
            'isLoggedIn' => false,
        ];
        if(!$wUser->getIsGuest()) {
            $data['isLoggedIn'] = true;
            $data['name'] = $wUser->getModel()->getFullName();
            $data['canManageMainPage'] = $wUser->canManageMainPage();
            $data['canManageAboutPage'] = $wUser->canManageAboutPage();
            $data['canManageNews'] = $wUser->canManageNews();
            $data['canManageArticles'] = $wUser->canManageArticles();
            $data['canManagePoolsBuildingPage'] = $wUser->canManagePoolsBuildingPage();
            $data['canManageObjectGalleries'] = $wUser->canManageObjectGalleries();
            $data['canManageServices'] = $wUser->canManageServices();
            $data['canManageCatalog'] = $wUser->canManageCatalog();
            $data['canManageUsers'] = $wUser->canManageUsers();
            $data['canManageOrders'] = $wUser->canManageOrders();
            $data['canManageSettings'] = $wUser->canManageSettings();
        }
        $resp = Yii::$app->getResponse();
        $resp->format = $resp::FORMAT_JSON;
        return $data;
    }

    /**
     * Инициализация языков
     * @return string
     */
    public function actionLanguagesInit() {
        /** @var Language[] $languages */
        $languages = LanguagesRepository::getInstance()->findAll();
        $data = [];
        foreach($languages as $language) {
            $data[] = [
                'id' => $language->getId(),
                'name' => $language->getName(),
            ];
        }
        return $this->getResponse($data);
    }

    /**
     * Логин пользователя
     * @return Response
     */
    public function actionLogin() {
        $wUser = $this->getWebUser();
        if(!$wUser->getIsGuest()) {
            return $this->getResponse('Пользователь уже залогинен', Response::FORMAT_RAW, 400);
        }
        $model = new LoginForm();
        $model->load($this->getRequestBodyJSON(), '');
        if($model->login()) {
            return 'ok';
        }
        $error = $this->getFirstModelError($model);
        return $this->getResponse($error, Response::FORMAT_RAW, 400);
    }

    /**
     * Логаут юзера
     * @return Response
     */
    public function actionLogout() {
        $wUser = $this->getWebUser();
        if($wUser->getIsGuest()) {
            return $this->getResponse('Пользователь не залогинен', Response::FORMAT_RAW, 400);
        }
        if(!$wUser->logout()) {
            return $this->getResponse('Произошла ошибка', Response::FORMAT_RAW, 400);
        }
        return $this->getResponse('ok', Response::FORMAT_RAW);
    }

    /**
     * Восстановление пароля
     * @return Response
     */
    public function actionPasswordRecovery() {
        $wUser = $this->getWebUser();
        if(!$wUser->getIsGuest()) {
            return $this->getResponse('Пользователь уже залогинен', Response::FORMAT_RAW, 400);
        }
        $model = new PasswordRecoveryForm();
        $model->load($this->getRequestBodyJSON(), '');
        if($model->sendRecoveryEmail()) {
            return $this->getResponse('ok', Response::FORMAT_RAW);
        }
        $error = $this->getFirstModelError($model);
        return $this->getResponse($error, Response::FORMAT_RAW, 400);
    }

    /**
     * Сброс пароля
     * @return Response
     */
    public function actionPasswordReset() {
        $resp = Yii::$app->getResponse();
        $resp->format = $resp::FORMAT_RAW;
        $wUser = $this->getWebUser();
        if(!$wUser->getIsGuest()) {
            return $this->getResponse('Пользователь уже залогинен', Response::FORMAT_RAW, 400);
        }
        $model = new PasswordResetForm();
        $model->load($this->getRequestBodyJSON(), '');
        if($model->resetPassword()) {
            return $this->getResponse('ok', Response::FORMAT_RAW);
        }
        $error = $this->getFirstModelError($model);
        return $this->getResponse($error, Response::FORMAT_RAW, 400);
    }

    private function getFirstModelError(Model $model) {
        $errors = [];
        foreach($model->getErrors() as $attrErrors) {
            $errors = array_merge($errors, $attrErrors);
        }
        return !empty($errors) ? array_shift($errors) : null;
    }

} 