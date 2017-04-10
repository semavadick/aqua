<?php

namespace app\controllers;

use app\repositories\ArticlesRepository;

class SearchController extends Controller {

    /**
     * Поиск
     * @param string|null $query
     * @param int|null $section
     * @return string
     */
    public function actionIndex($query = null, $section = null) {
        $form = $this->getSearchForm();
        $form->load(\Yii::$app->getRequest()->post());
        if(!empty($query)) {
            $form->query = $query;
        }
        if(!empty($section)) {
            $form->section = $section;
        }
        return $this->render('index', [
            'language' => self::getCurrentLanguage(),
            'form' => $form,
            'results' => $form->getSearchResults(),
            'resultsCount' => $form->getSearchResultsCount(),
            'articles' => ArticlesRepository::getInstance()->findArticlesForSearchPage(2, self::getCurrentLanguage()),
        ]);
    }

    /**
     * @param string|null $query
     * @param int|null $section
     * @return string
     */
    public static function getIndexUrl($query = null, $section = null) {
        $url = ['search/index'];
        if(!empty($query)) {
            $url['query'] = $query;
        }
        if(!empty($section)) {
            $url['section'] = $section;
        }
        return self::getUrlForCurrentLanguage($url);
    }

}