<?php

namespace app\controllers;

use app\forms\HelpForm;
use app\forms\OrderForm;
use app\forms\StoreCatalogForm;
use app\models\CatalogPage;
use app\models\Category;
use app\models\CategoryFilter;
use app\models\CategoryI18n;
use app\models\Entity;
use app\models\Product;
use app\models\ProductI18n;
use app\repositories\AdditionCategoriesRepository;
use app\repositories\AdditionProductsRepository;
use app\repositories\CategoriesRepository;
use app\repositories\ProductsRepository;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class StoreController extends Controller {

    /**
     * @return string
     */
    public function actionIndex() {
        $language = self::getCurrentLanguage();
        /** @var CatalogPage $page */
        $page = $this->getEntityManager()->getRepository('Models:CatalogPage')->find(0);
        $pageI18n = $page->getI18n($language);
        return $this->render('index', [
            'language' => $language,
            'page' => $page,
            'pageI18n' => $pageI18n,
            'categories' => $this->getCategories(),
        ]);
    }

    /**
     * @return string
     */
    public static function getIndexUrl() {
       return  self::getUrlForCurrentLanguage(['store/index']);
    }

    /**
     * Запрос каталога
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionSendCatalogRequest() {
        $form = new StoreCatalogForm();
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
     * Запрос помощи в выборе
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionSendHelpRequest() {
        $form = new HelpForm();
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
     * Грид
     * @param string $categorySlug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionStore($categorySlug) {
        $language = self::getCurrentLanguage();
        $category = CategoriesRepository::getInstance()->findCategoryBySlugAndLanguage($categorySlug, $language);
        $categories = [
            CategoriesRepository::getInstance()->findFirstLevelCategoriesByLanguage($language),
            AdditionCategoriesRepository::getInstance()->findFirstLevelCategoriesByLanguage($language)
            ];
        $addition_category = false;
        if(empty($category)) {
            $category = AdditionCategoriesRepository::getInstance()->findAdditionCategoryBySlugAndLanguage($categorySlug, $language);
            if(empty($category)){
                throw new NotFoundHttpException();
            }
            $addition_category = true;
        }
        $filters = $category->getFilters();
        $activeFilter = $category->getFilterById(\Yii::$app->getRequest()->get('filterId'));
        $pagination = new Pagination();
        $pagination->setPageSize(12);
        if(!$addition_category) {
            $products = ProductsRepository::getInstance()->findProductsForStorePage($language, $category, $activeFilter, $pagination);
            $relatedProducts = ProductsRepository::getInstance()->findRelatedProductsForStorePage(4, $language, $category, $activeFilter);
        } else {
            $products = AdditionProductsRepository::getInstance()->findProductsForStorePage($language, $category, $activeFilter, $pagination);
            $relatedProducts = AdditionProductsRepository::getInstance()->findRelatedProductsForStorePage(4, $language, $category, $activeFilter);
        }

        $grid_view = 'default';
        if(!empty(Yii::$app->getRequest()->getCookies()->get('grid-view'))) {
            $cookieView = Yii::$app->getRequest()->getCookies()->get('grid-view');
            $grid_view = $cookieView->value;
        }

        return $this->render('store', [
            'language' => $language,
            'grid_view' => $grid_view,
            'category' => $category,
            'categoryI18n' => $category->getI18n($language),
            'categories' => $categories,
            'filters' => $filters,
            'activeFilter' => $activeFilter,
            'products' => $products,
            'pagination' => $pagination,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    /**
     * @param Entity $filter
     * @return string
     */
    public function getCurrentUrlWithFilter(Entity $filter) {
        return Url::current(['filterId' => $filter->getId()]);
    }

    /**
     * @param Entity $category
     * @return string
     */
    public static function getStoreUrl(Entity $category) {
        /** @var CategoryI18n|null $categoryI18n */
        $categoryI18n = $category->getI18n(self::getCurrentLanguage());
        if(empty($categoryI18n)) {
            return null;
        }
        return self::getUrlForCurrentLanguage(['store/store', 'categorySlug' => $categoryI18n->getSlug()]);
    }

    /**
     * Карточка товара
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionProduct($slug) {
        $language = self::getCurrentLanguage();
        $product = ProductsRepository::getInstance()->findProductBySlugAndLanguage($slug, $language);
        $addition_product = false;
        if(empty($product)) {
            $product = AdditionProductsRepository::getInstance()->findProductBySlugAndLanguage($slug, $language);
            if(empty($product)){
                throw new NotFoundHttpException();
            }
            $addition_product = true;
        }

        $relatedProducts = (!$addition_product) ?
            ProductsRepository::getInstance()->findRelatedProductsForProductPage(4, $language, $product) :
            AdditionProductsRepository::getInstance()->findRelatedProductsForProductPage(4, $language, $product);

        /** @var CatalogPage $page */
        $page = $this->getEntityManager()->getRepository('Models:CatalogPage')->find(0);
        $pageI18n = $page->getI18n($language);
        $template_name = (!$addition_product) ? 'product' : 'addition-product';

        return $this->render($template_name, [
            'language' => $language,
            'product' => $product,
            'productI18n' => $product->getI18n($language),
            'relatedProducts' => $relatedProducts,
            'pageI18n' => $pageI18n,
        ]);
    }

    /**
     * @param Entity $product
     * @return string
     */
    public static function getProductUrl(Entity $product) {
        /** @var ProductI18n|null $productI18n */
        $productI18n = $product->getI18n(self::getCurrentLanguage());
        if(empty($productI18n)) {
            return null;
        }
        return self::getUrlForCurrentLanguage(['store/product', 'slug' => $productI18n->getSlug()]);
    }


    /**
     * Создание заказа
     * @return string
     * @throws BadRequestHttpException
     */
    public function actionCreateOrder() {
        $req = Yii::$app->getRequest();
        if(!$req->getIsAjax()) {
            throw new BadRequestHttpException();
        }

        $wUser = $this->getWebUser();
        $model = new OrderForm();
        $model->wUser = $wUser;
        $model->currency = $this->getCurrency();
        $model->load($req->post());
        $model->loadFile($_FILES);
        if(!$model->createOrder(self::getCurrentLanguage(), self::getCurrency())) {
            $errors = [];
            foreach($model->getErrors() as $attrErrors) {
                $errors = array_merge($errors, $attrErrors);
            }
            return $this->getResponse(implode("\n", $errors), 400);
        }
        $wUser->cleanCart();

        return 'ok';
    }

    /**
     * Синхронизация корзины
     * @return string
     */
    public function actionSyncCart() {
        $postProducts = isset($_POST['products']) && is_array($_POST['products'])
            ? $_POST['products']
            : [];

        $productIDs = [];
        $productQuantities = [];
        $productOptions = [];
        foreach($postProducts as $postProduct) {
            if(!isset($postProduct['id']) || !isset($postProduct['quantity']))
                continue;
            $productType = (isset($postProduct['type'])) ? $postProduct['type'] : 0;
            $productIDs[$productType][] = intval($postProduct['id']);
            if(!empty($postProduct['options']))
                $productOptions[$productType][$postProduct['id']] = $postProduct['options'];

            $productQuantities[$productType][$postProduct['id']] = intval($postProduct['quantity']);
        }

        $totalProducts = [];
        foreach($productIDs as $prType => $ids) {
            switch($prType) {
                case 1: {
                    $products = AdditionProductsRepository::getInstance()->findProductsForCart($ids);
                    break;
                }
                default: {
                    $products = ProductsRepository::getInstance()->findProductsForCart($ids);
                    break;
                }
            }
            foreach($products as &$product) {
                if(isset($productQuantities[$prType][$product->getId()]))
                    $product->setCartQuantity($productQuantities[$prType][$product->getId()]);

                if(isset($productOptions[$prType][$product->getId()])) {
                    $product->setCartOptions($productOptions[$prType][$product->getId()]);
                }
                $totalProducts[] = $product;
            }
        }

        $wUser = $this->getWebUser();
        $wUser->setCartProducts($totalProducts);

        return 'ok';
    }

    public function actionGridView($type){
        $accept_types = ['default', 'list-view', 'long-list-view'];
        if(in_array($type, $accept_types)) {
            $responseCookies = Yii::$app->getResponse()->getCookies();
            $responseCookies->add(new \yii\web\Cookie([
                'name' => 'grid-view',
                'value' => $type
            ]));
        }
    }

    /**
     * @return string
     */
    public static function getSyncCartUrl() {
        return self::getUrlForCurrentLanguage(['store/sync-cart']);
    }

}
