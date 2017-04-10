<?php

namespace app\controllers;

use app\models\News;
use app\models\NewsI18n;
use app\models\Publication;
use app\repositories\NewsRepository;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class NewsController extends Controller {

    /**
     * @return string
     */
    public function actionIndex() {
        $language = self::getCurrentLanguage();
        $pagination = new Pagination();
        $pagination->setPageSize(6);
        $topNewsItem = NewsRepository::getInstance()->findTopNewsItem($language);
        $news = NewsRepository::getInstance()->findNewsForNewsPage($language, $topNewsItem, $pagination);
        return $this->render('index', [
            'language' => $language,
            'topNewsItem' => $topNewsItem,
            'news' => $news,
            'pagination' => $pagination,
        ]);
    }

    /**
     * @return string
     */
    public static function getIndexUrl() {
        return self::getUrlForCurrentLanguage(['news/index']);
    }

    /**
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionNewsItem($slug) {
        $language = self::getCurrentLanguage();
        $newsItem = NewsRepository::getInstance()->findNewsItemBySlugAndLanguage($slug, $language);
        if(empty($newsItem)) {
            throw new NotFoundHttpException();
        }
        $newsItemI18n = $newsItem->getI18n($language);
        return $this->render('newsItem', [
            'language' => $language,
            'newsItem' => $newsItem,
            'newsItemI18n' => $newsItemI18n,
        ]);
    }

    /**
     * @param News $newsItem
     * @return string
     */
    public static function getNewsItemUrl(News $newsItem) {
        $language = self::getCurrentLanguage();
        /** @var NewsI18n|null $newsItemI18n */
        $newsItemI18n = $newsItem->getI18n($language);
        if(empty($newsItemI18n)) {
            return null;
        }
        return self::getUrlForCurrentLanguage(['news/news-item', 'slug' => $newsItemI18n->getSlug()]);
    }

    /**
     * @inheritdoc
     * @param News $publication
     */
    public function getPublicationUrl(Publication $publication) {
        return self::getNewsItemUrl($publication);
    }


}
