<?php

namespace sync\cli;

use app\components\Doctrine;
use app\models\CategoryI18n;
use app\models\Language;
use app\models\ProductI18n;
use app\repositories\CategoriesRepository;
use app\repositories\LanguagesRepository;
use app\repositories\ProductsRepository;
use Doctrine\ORM\EntityManager;
use sync\models\Parser;
use yii\console\Controller;

/**
 * Контроллер для синхронизации
 */
class SyncController extends Controller {

    /** @var EntityManager */
    private $em;

    /** @var string */
    private $importFilesDir;

    /** @inheritdoc */
    public function init() {
        parent::init();
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        $this->em = $doctrine->getEntityManager();
        $this->importFilesDir = \Yii::getAlias('@runtime');
    }

    /**
     * Синхронизация каталога
     */
    public function actionSyncAll() {
        $parser = new Parser($this->getImportXml(), $this->getOffersXml());

        $importCategories = $parser->getParsedCategories();
        /** @var \app\models\Category[] $dbCategories */
        $dbCategories = CategoriesRepository::getInstance()->findAll();
        $this->syncCategories($importCategories, $dbCategories);

        $importProducts = $parser->getParsedProducts();
        /** @var \app\models\Product[] $dbProducts */
        $dbProducts = ProductsRepository::getInstance()->findAll();
        $dbCategories = CategoriesRepository::getInstance()->findAll();
        $this->syncProducts($importProducts, $dbProducts, $dbCategories);

        $this->stdout("ok\n");
    }

    /**
     * Синхронизирует категории
     * @param \sync\models\Category[] $importCategories
     * @param \app\models\Category[] $dbCategories
     */
    private function syncCategories($importCategories, $dbCategories) {
        $indxCategories = $this->getCategoriesIndexedByImportId($dbCategories);
        $categoriesToDelete = [];
        foreach($dbCategories as $category) {
            $categoriesToDelete[$category->getId()] = $category;
        }
        $lang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        $em = $this->em;

        foreach($importCategories as $importCategory) {

            if(isset($indxCategories[$importCategory->id])) {
                $category = $indxCategories[$importCategory->id];
                unset($categoriesToDelete[$category->getId()]);

            } else {
                $category = new \app\Models\Category();
                $indxCategories[$importCategory->id] = $category;
            }
            $em->persist($category);

            $category->setImportId($importCategory->id);

            // Name
            $i18n = $category->getI18n($lang);
            if(empty($i18n)) {
                $i18n = new CategoryI18n();
                $i18n->setLanguage($lang);
                $i18n->setCategory($category);
            }
            $em->persist($i18n);
            $i18n->setName($importCategory->name);

            // Parent category
            $parent = null;
            if(!empty($importCategory->parent)) {
                $importParent = $importCategory->parent;
                $parent = isset($indxCategories[$importParent->id]) ? $indxCategories[$importParent->id] : null;
            }
            $category->setParent($parent);
        }

        foreach($categoriesToDelete as $category) {
            $em->remove($category);
        }

        $em->flush();
    }

    /**
     * @param \app\models\Category[] $categories
     * @return \app\models\Category[] Массив категорий, проиндексированных по importId
     */
    private function getCategoriesIndexedByImportId($categories) {
        $indxCategories = [];
        foreach($categories as $category) {
            $indxCategories[$category->getImportId()] = $category;
        }
        return $indxCategories;
    }

    /**
     * Синхронизирует товары
     * @param \sync\models\Product[] $importProducts
     * @param \app\models\Product[] $dbProducts
     * @param \app\models\Category[] $dbCategories
     */
    private function syncProducts($importProducts, $dbProducts, $dbCategories) {
        $indxCategories = $this->getCategoriesIndexedByImportId($dbCategories);
        $indxProducts = $this->getProductsIndexedByImportId($dbProducts);
        $productsToDelete = [];
        foreach($dbProducts as $product) {
            $productsToDelete[$product->getId()] = $product;
        }
        $lang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        $em = $this->em;

        foreach($importProducts as $importProduct) {

            if(isset($indxProducts[$importProduct->id])) {
                $product = $indxProducts[$importProduct->id];
                unset($productsToDelete[$product->getId()]);

            } else {
                $product = new \app\Models\Product();
                $indxProducts[$importProduct->id] = $product;
            }
            $em->persist($product);

            $product->setImportId($importProduct->id);
            $product->setPrice($importProduct->price);
            $product->setSku($importProduct->sku);

            // Name
            $i18n = $product->getI18n($lang);
            if(empty($i18n)) {
                $i18n = new ProductI18n();
                $i18n->setLanguage($lang);
                $i18n->setProduct($product);
            }
            $em->persist($i18n);
            $i18n->setName($importProduct->name);

            // Category
            $category = null;
            if(!empty($importProduct->category)) {
                $importCategory = $importProduct->category;
                $category = isset($indxCategories[$importCategory->id]) ? $indxCategories[$importCategory->id] : null;
            }
            $product->setCategory($category);

        }

        foreach($productsToDelete as $product) {
            $em->remove($product);
        }

        $em->flush();
    }

    /**
     * @param \app\models\Product[] $products
     * @return \app\models\Product[] Массив товаров, проиндексированных по importId
     */
    private function getProductsIndexedByImportId($products) {
        $indxProducts = [];
        foreach($products as $product) {
            $indxProducts[$product->getImportId()] = $product;
        }
        return $indxProducts;
    }


    /** @return \SimpleXMLElement */
    private function getImportXml() {
        return simplexml_load_file($this->importFilesDir . '/import.xml');
    }

    /** @return \SimpleXMLElement */
    private function getOffersXml() {
        return simplexml_load_file($this->importFilesDir . '/offers.xml');
    }

}