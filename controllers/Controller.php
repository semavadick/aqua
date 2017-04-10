<?php

namespace app\controllers;

use app\assets\General;
use app\components\Doctrine;
use app\forms\SearchForm;
use app\helpers\PriceHelper;
use app\models\Category;
use app\models\Currency;
use app\models\Language;
use app\repositories\CategoriesRepository;
use app\repositories\AdditionCategoriesRepository;
use app\repositories\CurrenciesRepository;
use app\repositories\LanguagesRepository;
use app\repositories\SettingsRepository;
use Doctrine\ORM\EntityManager;
use Yii;
use yii\base\Model;
use yii\web\AssetManager;
use yii\web\JqueryAsset;
use yii\web\Response;
use yii\web\YiiAsset;
use yii\helpers\Url;

/**
 * Базовый класс для всех контроллеров
 */
abstract class Controller extends \yii\web\Controller {
    /**
     * @inheritdoc
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        // Свой вид на всех контрллерах
        Yii::$app->set('view', 'app\components\View');

        // Все ассеты виджетов yii
        // должны зависеть от общего ассета
        Yii::$app->set('assetManager', [
            'class' => AssetManager::className(),
            'forceCopy' => Yii::$app->getAssetManager()->forceCopy,
            'bundles' => [
                YiiAsset::className() => [
                    'depends' => [
                        General::className(),
                    ]
                ],
                JqueryAsset::className() => false,
            ],
        ]);
    }

    /**
     * @return \app\components\WebUser Инстанс объекта посетителя
     */
    public function getWebUser()
    {
        return Yii::$app->getUser();
    }

    /** @return Language */
    public static function getCurrentLanguage() {
        $lang = LanguagesRepository::getInstance()->findLanguageByCode(Yii::$app->language);
        if(empty($lang)) {
            $lang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_DEFAULT);
        }
        return $lang;
    }

    /**
     * @param Language $language
     * @return bool
     */
    public function languageIsCurrent(Language $language) {
        return self::getCurrentLanguage()->getId() == $language->getId();
    }

    /**
     * @param array $url
     * @return string
     */
    protected static function getUrlForCurrentLanguage($url) {
        return Url::to($url + ['language' => self::getCurrentLanguage()->getCode()]);
    }

    /** @return Language[] */
    public function getLanguages() {
        return LanguagesRepository::getInstance()->findAll();
    }

    /**
     * @param Language $language
     * @return string
     */
    public function getCurrentUrlForLanguage(Language $language) {
        return Url::to(['site/index', 'language' => $language->getCode()]);
        return Url::current(['language' => $language->getCode()]);
    }

    /** @return EntityManager */
    protected function getEntityManager() {
        /** @var Doctrine $doctrine */
        $doctrine = Yii::$app->get('doctrine');
        return $doctrine->getEntityManager();
    }

    /**
     * @param Model $model
     * @return array
     */
    protected function getAllModelErrors(Model $model) {
        $errors = [];
        foreach($model->getErrors() as $attrErrors) {
            $errors = array_merge($errors, $attrErrors);
        }
        return $errors;
    }

    /**
     * @return \app\models\Setting
     */
    public function getSetting() {
        return SettingsRepository::getInstance()->findSetting();
    }

    /** @return Category[] */
    public function getCategories() {
        $categories = [
            CategoriesRepository::getInstance()->findFirstLevelCategories(),
            AdditionCategoriesRepository::getInstance()->findFirstLevelCategories()
        ];
        return $categories;
    }

    /** @return Currency */
    public function getCurrency() {
        return CurrenciesRepository::getInstance()->findCurrencyForLanguage(self::getCurrentLanguage());
    }

    /** @return PriceHelper */
    public function getPriceHelper() {
        return new PriceHelper($this->getCurrency(), $this->getWebUser());
    }

    private $searchForm = null;

    /** @return SearchForm */
    public function getSearchForm() {
        if(empty($this->searchForm)) {
            $this->searchForm = new SearchForm();
            $this->searchForm->language = self::getCurrentLanguage();
        }
        return $this->searchForm;
    }

    protected function getResponse($data, $statsCode = 200, $format = Response::FORMAT_RAW) {
        $response = \Yii::$app->getResponse();
        $response->format = $format;
        $response->setStatusCode($statsCode);
        $response->data = $data;
        return $response;
    }

} 