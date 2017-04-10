<?php

namespace app\forms;

use app\assets\About;
use app\components\Doctrine;
use app\controllers\AboutController;
use app\controllers\ArticlesController;
use app\controllers\BuildingController;
use app\controllers\GalleriesController;
use app\controllers\NewsController;
use app\controllers\ServicesController;
use app\controllers\StoreController;
use app\models\AboutPage;
use app\models\AboutPageI18n;
use app\models\ArticleI18n;
use app\models\CategoryI18n;
use app\models\FaqItemI18n;
use app\models\HistoryStageI18n;
use app\models\Language;
use app\models\NewsI18n;
use app\models\ObjectGallery;
use app\models\ObjectGalleryI18n;
use app\models\PoolsBuildingPage;
use app\models\PoolsBuildingPageI18n;
use app\models\PoolTypeI18n;
use app\models\ProductI18n;
use app\models\ServiceI18n;
use app\models\TechAdvantageI18n;
use app\repositories\AdditionCategoriesRepository;
use app\repositories\AdditionProductsRepository;
use app\repositories\ArticlesRepository;
use app\repositories\CategoriesRepository;
use app\repositories\FaqItemsRepository;
use app\repositories\HistoryStagesRepository;
use app\repositories\NewsRepository;
use app\repositories\ObjectGalleriesRepository;
use app\repositories\PoolTypesRepository;
use app\repositories\ProductsRepository;
use app\repositories\ServicesRepository;
use app\repositories\TechAdvantagesRepository;
use Yii;

class SearchForm extends Form {

    /** Раздел О компании */
    CONST SECTION_ABOUT = 1;

    /** Раздел Строительство */
    CONST SECTION_BUILDING = 2;

    /** Раздел Услуги */
    CONST SECTION_SERVICES = 3;

    /** Раздел Каталог */
    CONST SECTION_STORE = 4;

    /** Раздел База знаний */
    CONST SECTION_ARTICLES = 5;

    /** Раздел Новости */
    CONST SECTION_NEWS = 6;

    public $section = self::SECTION_STORE;

    /** @var Language Язык поиска */
    public $language;

    /** @var string Запрос */
    public $query;

    /** Мин. длина запроса */
    const MIN_QUERY_LENGTH = 3;

    /** Макс. кол-во результатов */
    const MAX_RESULTS = 30;

    /** Мин. длина текста результата */
    const MAX_RESULT_TEXT_LENGTH = 300;

    /** @inheritdoc  */
    public function rules() {
        return [
            [['query', 'type'], 'safe'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels() {
        return [
            'query' => Yii::t('app', 'your query'),
        ];
    }

    /**
     * @return SearchResult[] Результаты поиска
     */
    public function getSearchResults() {
        $this->query = trim($this->query);
        if(strlen($this->query) < self::MIN_QUERY_LENGTH) {
            return [];
        }

        switch($this->section) {
            case self::SECTION_ABOUT:
                $results = $this->getAboutSearchResults();
                break;

            case self::SECTION_BUILDING:
                $results = $this->getBuildingSearchResults();
                break;

            case self::SECTION_SERVICES:
                $results = $this->getServicesSearchResults();
                break;

            case self::SECTION_ARTICLES:
                $results = $this->getArticlesSearchResults();
                break;

            case self::SECTION_NEWS:
                $results = $this->getNewsSearchResults();
                break;

            case self::SECTION_STORE:
            default:
                $results = $this->getStoreSearchResults();
                break;
        }

        if(!empty($results)) {
            return $results;
        }

        $resultsCount = $this->getSearchResultsCount();
        foreach($resultsCount as $section => $resultCount) {
            if(empty($resultCount)) {
                continue;
            }
            $this->section = $section;
            return $this->getSearchResults();
        }

        return [];
    }

    private function getRepository($entityName) {
        /** @var Doctrine $doctrine */
        $doctrine = Yii::$app->get('doctrine');
        return $doctrine->getEntityManager()->getRepository($entityName);
    }

    private $aboutResults = null;

    /** @return SearchResult[] */
    private function getAboutSearchResults() {
        if(!is_null($this->aboutResults)) {
            return $this->aboutResults;
        }

        $results = [];

        $stages = HistoryStagesRepository::getInstance()->findStagesByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($stages as $stage) {
            /** @var HistoryStageI18n $i18n */
            $i18n = $stage->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getText()
            ]);
            $link = AboutController::getIndexUrl('history');
            $results[] = new SearchResult($text, $link);
        }

        /** @var AboutPage $page */
        $page = $this->getRepository('Models:AboutPage')->find(0);
        /** @var AboutPageI18n $pageI18n */
        $pageI18n = $page->getI18n($this->language);

        $competenceText = $this->highlightQuery([
            $pageI18n->getCompetenceText(), $pageI18n->getCompetenceTitle()
        ]);
        if(!empty($competenceText)) {
            $results[] = new SearchResult($competenceText, AboutController::getIndexUrl('competence'));
        }

        $prodText = $this->highlightQuery([
            $pageI18n->getProductionText(), $pageI18n->getProductionTitle()
        ]);
        if(!empty($prodText)) {
            $results[] = new SearchResult($prodText, AboutController::getIndexUrl('manufacturing'));
        }

        $this->aboutResults = $results;
        return $results;
    }

    private $buildingResults = null;

    /** @return SearchResult[] */
    private function getBuildingSearchResults() {
        if(!is_null($this->buildingResults)) {
            return $this->buildingResults;
        }

        $results = [];

        $types = PoolTypesRepository::getInstance()->findTypesByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($types as $type) {
            /** @var PoolTypeI18n $i18n */
            $i18n = $type->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getName(), $i18n->getDescription()
            ]);
            $link = BuildingController::getTypeUrl($type);
            $results[] = new SearchResult($text, $link);
        }

        $galleries = ObjectGalleriesRepository::getInstance()->findGalleriesByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($galleries as $gallery) {
            /** @var ObjectGalleryI18n $i18n */
            $i18n = $gallery->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getName(), $i18n->getDescription()
            ]);
            $link = GalleriesController::getGalleryUrl($gallery);
            $results[] = new SearchResult($text, $link);
        }

        $advantages = TechAdvantagesRepository::getInstance()->findAdvantagesByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($advantages as $advantage) {
            /** @var TechAdvantageI18n $i18n */
            $i18n = $advantage->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getTagline(), $i18n->getText()
            ]);
            $link = BuildingController::getIndexUrl('advantages');
            $results[] = new SearchResult($text, $link);
        }
        
        /** @var PoolsBuildingPage $page */
        $page = $this->getRepository('Models:PoolsBuildingPage')->find(0);
        /** @var PoolsBuildingPageI18n $pageI18n */
        $pageI18n = $page->getI18n($this->language);

        $projText = $this->highlightQuery([
            $pageI18n->getProjectText(), $pageI18n->getProjectTitle()
        ]);
        if(!empty($projText)) {
            $results[] = new SearchResult($projText, BuildingController::getIndexUrl('planning'));
        }

        $designText = $this->highlightQuery([
            $pageI18n->getDesignText(), $pageI18n->getDesignTitle()
        ]);
        if(!empty($designText)) {
            $results[] = new SearchResult($designText, BuildingController::getIndexUrl('design'));
        }

        $buildingText = $this->highlightQuery([
            $pageI18n->getBuildingText(), $pageI18n->getBuildingTitle()
        ]);
        if(!empty($buildingText)) {
            $results[] = new SearchResult($buildingText, BuildingController::getIndexUrl('building'));
        }

        $faqItems = FaqItemsRepository::getInstance()->findItemsByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($faqItems as $item) {
            /** @var FaqItemI18n $i18n */
            $i18n = $item->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getQuestion(), $i18n->getAnswer()
            ]);
            $link = BuildingController::getIndexUrl('faq');
            $results[] = new SearchResult($text, $link);
        }

        $this->buildingResults = $results;
        return $results;
    }

    private $servicesResults = null;

    /** @return SearchResult[] */
    private function getServicesSearchResults() {
        if(!is_null($this->servicesResults)) {
            return $this->servicesResults;
        }

        $results = [];

        $maint = ServicesRepository::getInstance()->findMaintenanceService();
        /** @var ServiceI18n $i18n */
        $i18n = $maint->getI18n($this->language);
        $text = $this->highlightQuery([
            $i18n->getDescription()
        ]);
        if(!empty($text)) {
            $results[] = new SearchResult($text, ServicesController::getMaintenanceUrl());
        }

        $exclusive = ServicesRepository::getInstance()->findExclusiveService();
        /** @var ServiceI18n $i18n */
        $i18n = $exclusive->getI18n($this->language);
        $text = $this->highlightQuery([
            $i18n->getDescription(), $i18n->getAdditDescription(),
        ]);
        if(!empty($text)) {
            $results[] = new SearchResult($text, ServicesController::getExclusiveUrl());
        }

        $this->servicesResults = $results;
        return $results;
    }

    private $articlesResults = null;

    /** @return SearchResult[] */
    private function getArticlesSearchResults() {
        if(!is_null($this->articlesResults)) {
            return $this->articlesResults;
        }

        $results = [];

        $articles = ArticlesRepository::getInstance()->findArticlesByText($this->language, $this->query, self::MAX_RESULTS);
        foreach($articles as $article) {
            /** @var ArticleI18n $i18n */
            $i18n = $article->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getName(), $i18n->getDescription()
            ]);
            $link = ArticlesController::getArticleUrl($article);
            $results[] = new SearchResult($text, $link);
        }

        $this->articlesResults = $results;
        return $results;
    }

    private $newsResults = null;

    /** @return SearchResult[] */
    private function getNewsSearchResults() {
        if(!is_null($this->newsResults)) {
            return $this->newsResults;
        }

        $results = [];

        $news = NewsRepository::getInstance()->findNewsByText($this->language, $this->query, self::MAX_RESULTS);
        foreach($news as $newsItem) {
            /** @var NewsI18n $i18n */
            $i18n = $newsItem->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getName(), $i18n->getDescription()
            ]);
            $link = NewsController::getNewsItemUrl($newsItem);
            $results[] = new SearchResult($text, $link);
        }

        $this->newsResults = $results;
        return $results;
    }

    /** @return SearchResult[] */
    private function getStoreSearchResults() {
        $results = [];

        $categories = CategoriesRepository::getInstance()->findCategoriesByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($categories as $category) {
            /** @var CategoryI18n $i18n */
            $i18n = $category->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getName(), $i18n->getDescription()
            ]);
            $link = StoreController::getStoreUrl($category);
            $results[] = new SearchResult($text, $link);
        }

        $categories = AdditionCategoriesRepository::getInstance()->findCategoriesByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($categories as $category) {
            /** @var AdditionCategoryI18n $i18n */
            $i18n = $category->getI18n($this->language);
            $text = $this->highlightQuery([
                $i18n->getName(), $i18n->getDescription()
            ]);
            $link = StoreController::getStoreUrl($category);
            $results[] = new SearchResult($text, $link);
        }

        $products = ProductsRepository::getInstance()->findProductsByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($products as $product) {
            /** @var ProductI18n $i18n */
            $i18n = $product->getI18n($this->language);
            $text = $this->highlightQuery([
                $product->getSku(), $i18n->getName(), $i18n->getDescription()
            ]);
            $link = StoreController::getProductUrl($product);
            $results[] = new SearchResult($text, $link);
        }

        $products = AdditionProductsRepository::getInstance()->findProductsByText($this->language, $this->query, self::MAX_RESULTS - count($results));
        foreach($products as $product) {
            /** @var AdditionProductI18n $i18n */
            $i18n = $product->getI18n($this->language);
            $text = $this->highlightQuery([
                $product->getSku(), $i18n->getName(), $i18n->getDescription()
            ]);
            $link = StoreController::getProductUrl($product);
            $results[] = new SearchResult($text, $link);
        }

        return $results;
    }

    /**
     * @param string[] $texts
     * @return string
     */
    private function highlightQuery($texts) {
        $result = '';
        $query = $this->query;
        $maxOffset = floor((self::MAX_RESULT_TEXT_LENGTH - strlen($query)) / 2);
        foreach($texts as $text) {
            $text = strip_tags($text);

            $fPos = mb_stripos($text, $query);
            if($fPos === false) {
                continue;
            }

            $offset = $fPos - $maxOffset;
            if($offset < 0) {
                $offset = 0;
            }
            $maxLength = mb_strlen($text) - $offset;
            $length = $maxLength < self::MAX_RESULT_TEXT_LENGTH ? $maxLength : self::MAX_RESULT_TEXT_LENGTH;
            $text = mb_substr($text, $offset, $length);

            if($offset > 0) {
                $text = '...' . $text;
            }
            if($maxLength > self::MAX_RESULT_TEXT_LENGTH ) {
                $text .= '...';
            }

            $result = preg_replace("/(" . preg_quote($query, '/') . ")/iu", "<b>$1</b>", $text);
            break;
        }
        return $result;
    }

    /**
     * @return int[] Кол-во результатов поиска по разделам (section => count)
     */
    public function getSearchResultsCount() {
        $this->query = trim($this->query);
        if(strlen($this->query) < self::MIN_QUERY_LENGTH) {
            return [];
        }
        return [
            self::SECTION_ABOUT => count($this->getAboutSearchResults()),
            self::SECTION_BUILDING => count($this->getBuildingSearchResults()),
            self::SECTION_SERVICES => count($this->getServicesSearchResults()),
            self::SECTION_STORE => count($this->getStoreSearchResults()),
            self::SECTION_ARTICLES => count($this->getArticlesSearchResults()),
            self::SECTION_NEWS => count($this->getNewsSearchResults()),
        ];
    }

}

class SearchResult {

    public $text;

    public $link;

    public function __construct($text, $link) {
        $this->text = $text;
        $this->link = $link;
    }

}