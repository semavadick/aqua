<?php

namespace app\controllers;

use app\forms\ApplicationForm;
use app\forms\CatalogForm;
use app\forms\DiscountForm;
use app\forms\ManagerContactForm;
use app\models\MainPage;
use app\models\MainPageI18n;
use app\repositories\ArticlesRepository;
use app\repositories\MainPageBannersRepository;
use app\repositories\MainPageSlidesRepository;
use app\repositories\NewsRepository;
use yii\web\BadRequestHttpException;

class SiteController extends Controller {

    /**
     * @inheritDoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Главная страница
     * @return string
     */
    public function actionIndex() {
        $language = self::getCurrentLanguage();
        /** @var MainPage $page */
        $page = $this->getEntityManager()->find('Models:MainPage', 0);
        /** @var MainPageI18n $pageI18n */
        $pageI18n = $page->getI18n($language);
        $slides = MainPageSlidesRepository::getInstance()->findSlidesForMainPage($language);
        $banners = MainPageBannersRepository::getInstance()->findBannersForMainPage(3, $language);
        $news = NewsRepository::getInstance()->findNewsForMainPage(1, $language);
        $articles = ArticlesRepository::getInstance()->findArticlesForMainPage(2, $language);
        return $this->render('index', [
            'language' => $language,
            'page' => $page,
            'pageI18n' => $pageI18n,
            'slides' => $slides,
            'banners' => $banners,
            'news' => $news,
            'articles' => $articles,
        ]);
    }

    /**
     * Запрос каталога
     */
    public function actionSendCatalogRequest() {
        $form = new CatalogForm();
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
     * Запрос связи с менеджером
     */
    public function actionContactManager() {
        $form = new ManagerContactForm();
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
     * Заявка
     */
    public function actionSendApplication() {
        $form = new ApplicationForm();
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
     * Скидка
     */
    public function actionSendDiscountRequest() {
        $form = new DiscountForm();
        if(!$form->load(\Yii::$app->getRequest()->post())) {
            throw new BadRequestHttpException(400);
        }
        if(!$form->sendRequest()) {
            $errors = $this->getAllModelErrors($form);
            return $this->getResponse(implode("\n", $errors), 400);
        }
        return 'ok';
    }

    /** @return string */
    public static function getIndexUrl() {
        return self::getUrlForCurrentLanguage(['site/index']);
    }

}
