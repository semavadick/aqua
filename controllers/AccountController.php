<?php

namespace app\controllers;

use app\forms\LoginForm;
use app\forms\ProfileForm;
use app\forms\RegistrationForm;
use yii\web\BadRequestHttpException;

class AccountController extends Controller {

    /**
     * @return string
     */
    public function actionProfile() {
        $language = self::getCurrentLanguage();
        $wUser = $this->getWebUser();
        $user = $wUser->getModel();
        if($wUser->getIsGuest() || empty($user)) {
            return $this->redirect(SiteController::getIndexUrl());
        }
        $formModel = new ProfileForm();
        $formModel->setUser($user);
        return $this->render('profile', [
            'language' => $language,
            'user' => $user,
            'formModel' => $formModel,
            'orders' => $user->getOrders(),
        ]);
    }

    /**
     * Сохранение данных профиля
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionSaveProfile() {
        $form = new ProfileForm();$wUser = $this->getWebUser();
        $user = $wUser->getModel();
        if($wUser->getIsGuest() || empty($user)) {
            throw new BadRequestHttpException(400);
        }
        $form->setUser($user);
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        if(!$form->save()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';

    }

    /**
     * @return string
     */
    public static function getProfileUrl() {
        return self::getUrlForCurrentLanguage(['account/profile']);
    }

    /**
     * Логин
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionLogin() {
        $form = new LoginForm();
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        if(!$form->login()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

    /**
     * Регистрация
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionRegister() {
        $form = new RegistrationForm();
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        $form->loadFile($_FILES);
        if(!$form->register()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

    /**
     * Выход
     * @return \yii\web\Response
     */
    public function actionLogout() {
        $this->getWebUser()->logout();
        return $this->redirect(SiteController::getIndexUrl());
    }

    /**
     * @return string
     */
    public static function getLogoutUrl() {
        return self::getUrlForCurrentLanguage(['account/logout']);
    }

}
