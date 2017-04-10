<?php

namespace back\Catalog\controllers;

use app\models\Attachment;
use app\models\Category;
use app\models\Entity;
use app\models\Product;
use app\repositories\CategoriesRepository;
use app\repositories\ProductsRepository;
use back\controllers\TableCrudController;
use back\Catalog\forms\ProductForm;
use back\Catalog\forms\ProductsSearchForm;

class ProductsController extends TableCrudController {

    public function actionFormSelect() {
        $data = [
            'attachments' => [],
            'filters' => [],
            'relatedProducts' => [],
        ];

        /** @var Attachment[] $attachments */
        $attachments = $this->getEntityManager()->getRepository('Models:Attachment')->findAll();
        foreach($attachments as $attachment) {
            $data['attachments'][] = [
                'id' => $attachment->getId(),
                'name' => $attachment->getText(),
            ];
        }

        $categoryId = \Yii::$app->getRequest()->get('categoryId');
        if(!empty($categoryId)) {
            /** @var Category|null $category */
            $category = CategoriesRepository::getInstance()->find($categoryId);
            if(!empty($category)) {
                foreach($category->getFilters() as $filter) {
                    $data['filters'][] = [
                        'id' => $filter->getId(),
                        'name' => $filter->getText(),
                    ];
                }
            }
        }

        $productId = \Yii::$app->getRequest()->get('productId');
        if(!empty($productId)) {
            /** @var Product|null $product */
            $product = ProductsRepository::getInstance()->find($productId);
            if(!empty($product)) {
                foreach($product->getRelatedProducts() as $relatedProduct) {
                    $data['relatedProducts'][] = [
                        'id' => $relatedProduct->getId(),
                        'name' => $relatedProduct->getName() . ' (' . $relatedProduct->getSku() . ')',
                    ];
                }
            }
        }

        return $this->getResponse($data);
    }

    public function actionRelatedProducts() {
        $form = $this->createSearchForm();
        $form->name = \Yii::$app->getRequest()->get('query');
        $id = \Yii::$app->getRequest()->get('id');
        $form->limit = 50;
        /** @var Product[] $products */
        $products = $form->findEntities();
        $data = [];
        foreach($products as $product) {
            if($product->getId() == $id) {
                continue;
            }
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName() . ' (' . $product->getSku() . ')',
            ];
        }
        return $this->getResponse($data);
    }

    public function actionSort(){
        $data = [];
        if(\Yii::$app->getRequest()->getIsPost()) {
            $postData = $this->getRequestBodyJSON();
            $productIds = $postData['ids'];
            $db = \Yii::$app->getDb();
            $sort = ($postData['direction'] == 0) ? 1 : count($productIds);
            foreach($productIds as $productId) {
                $cmd = $db->createCommand("UPDATE `Product` SET `sort` = ".$sort." WHERE id = ".$productId);
                $cmd->execute();
                if($postData['direction'] == 0) {
                    $sort++;
                } else $sort--;
            }
            $data['success'] = 1;
        }
        return $this->getResponse($data);
    }

    /** @inheritdoc */
    protected function createEntityForm() {
        return new ProductForm();
    }

    /** @inheritdoc*/
    protected function getEntityRepository() {
        return ProductsRepository::getInstance();
    }

    /**
     * @inheritdoc
     * @param Product $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'sku' => $entity->getSku(),
            'price' => $entity->getPrice(),
            'sort' => $entity->getSort()
        ];
    }

    /** @inheritdoc */
    protected function createSearchForm() {
        return new ProductsSearchForm();
    }

    /** @return boolean */
    protected function checkAccess() {
        return $this->getWebUser()->canManageCatalog();
    }

}