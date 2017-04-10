<?php

namespace back\Catalog\controllers;

use app\models\Attachment;
use app\models\AdditionCategory;
use app\models\Entity;
use app\models\AdditionProduct;
use app\repositories\AdditionCategoriesRepository;
use app\repositories\AdditionProductsRepository;
use back\controllers\TableCrudController;
use back\Catalog\forms\AdditionProductForm;
use back\Catalog\forms\AdditionProductsSearchForm;
use back\Catalog\forms\ProductsSearchForm;

class AdditionProductsController extends TableCrudController {

    public function actionFormSelect() {
        $data = [
            'relatedProducts' => [],
        ];

        $productId = \Yii::$app->getRequest()->get('productId');
        if(!empty($productId)) {
            /** @var AdditionProduct|null $product */
            $product = AdditionProductsRepository::getInstance()->find($productId);
            if(!empty($product)) {
                foreach($product->getRelatedProducts() as $relatedProduct) {
                    $data['relatedProducts'][] = [
                        'id' => $relatedProduct->getId(),
                        'name' => $relatedProduct->getName() . ' (' . $relatedProduct->getSku() . ')',
                        'type' => 0,
                    ];
                }
                foreach($product->getRelatedAdditionProducts() as $relatedAdditionProduct) {
                    $data['relatedProducts'][] = [
                        'id' => $relatedAdditionProduct->getId(),
                        'name' => $relatedAdditionProduct->getName() . ' (' . $relatedAdditionProduct->getSku() . ')',
                        'type' => 1
                    ];
                }
            }
        }

        return $this->getResponse($data);
    }

    public function actionRelatedProducts() {
        $additionForm = $this->createSearchForm();
        $defaultForm = new ProductsSearchForm();
        $query = \Yii::$app->getRequest()->get('query');
        $additionForm->name = $query;
        $defaultForm->name = $query;
        $id = \Yii::$app->getRequest()->get('id');
        $limit = 50;
        $additionForm->limit = $limit;
        $defaultForm->limit = $limit;
        /** @var AdditionProduct[] $additionProducts */
        $additionProducts = $additionForm->findEntities();
        /** @var Product[] $defaultProducts */
        $defaultProducts = $defaultForm->findEntities();
        $data = [];
        foreach($additionProducts as $additionProduct) {
            if($additionProduct->getId() == $id) {
                continue;
            }
            $data[] = [
                'id' => $additionProduct->getId(),
                'name' => $additionProduct->getName() . ' (' . $additionProduct->getSku() . ')',
                'type' => 1
            ];
        }
        foreach($defaultProducts as $product) {
            if($product->getId() == $id) {
                continue;
            }
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName() . ' (' . $product->getSku() . ')',
                'type' => 0
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
                $cmd = $db->createCommand("UPDATE `AdditionProduct` SET `sort` = ".$sort." WHERE id = ".$productId);
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
        return new AdditionProductForm();
    }

    /** @inheritdoc*/
    protected function getEntityRepository() {
        return AdditionProductsRepository::getInstance();
    }

    /**
     * @inheritdoc
     * @param AdditionProduct $entity
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
        return new AdditionProductsSearchForm();
    }

    /** @return boolean */
    protected function checkAccess() {
        return $this->getWebUser()->canManageCatalog();
    }

}