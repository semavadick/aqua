<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleI18n;
use app\models\Category;
use app\models\CategoryI18n;
use app\models\Publication;
use app\repositories\ArticlesRepository;
use app\repositories\CategoriesRepository;
use app\repositories\ProductsRepository;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ArticlesController extends PublicationsController {

    /**
     * @return string
     */
    public function actionIndex() {
        $language = self::getCurrentLanguage();
        $categorySlug = \Yii::$app->getRequest()->get('categorySlug');
        $activeCategory = !empty($categorySlug) ? CategoriesRepository::getInstance()->findCategoryBySlugAndLanguage($categorySlug, $language) : null;
        $categories = CategoriesRepository::getInstance()->findFirstLevelCategoriesByLanguage($language);
        $pagination = new Pagination();
        $pagination->setPageSize(6);
        $topArticle = ArticlesRepository::getInstance()->findTopArticle($language, $activeCategory);
        $articles = ArticlesRepository::getInstance()->findArticlesForKnowledgePage($language, $activeCategory, $topArticle, $pagination);
        $products = ProductsRepository::getInstance()->findProductsForKnowledgePage(4, $language, $activeCategory);
        return $this->render('index', [
            'language' => $language,
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'topArticle' => $topArticle,
            'articles' => $articles,
            'pagination' => $pagination,
            'products' => $products,
        ]);
    }

    /**
     * @param Category|null $category
     * @return string
     */
    public static function getIndexUrl(Category $category = null) {
        $url = ['articles/index'];
        if(!empty($category)) {
            $language = self::getCurrentLanguage();
            /** @var CategoryI18n|null $categoryI18n */
            $categoryI18n = $category->getI18n($language);
            if(!empty($categoryI18n)) {
                $url['categorySlug'] = $categoryI18n->getSlug();
            }
        }
        return self::getUrlForCurrentLanguage($url);
    }

    /**
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionArticle($slug) {
        $language = self::getCurrentLanguage();
        $article = ArticlesRepository::getInstance()->findArticleBySlugAndLanguage($slug, $language);
        if(empty($article)) {
            throw new NotFoundHttpException();
        }
        $articleI18n = $article->getI18n($language);
        $products = ProductsRepository::getInstance()->findProductsForArticlePage(4, $language, $article);
        return $this->render('article', [
            'language' => $language,
            'article' => $article,
            'articleI18n' => $articleI18n,
            'products' => $products,
        ]);
    }

    /**
     * @param Article $article
     * @return string
     */
    public static function getArticleUrl(Article $article) {
        $language = self::getCurrentLanguage();
        /** @var ArticleI18n|null $articleI18n */
        $articleI18n = $article->getI18n($language);
        if(empty($articleI18n)) {
            return null;
        }
        return self::getUrlForCurrentLanguage(['articles/article', 'slug' => $articleI18n->getSlug()]);
    }

    /**
     * @inheritdoc
     * @param Article $publication
     */
    public function getPublicationUrl(Publication $publication) {
        return self::getArticleUrl($publication);
    }

}
