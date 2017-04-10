<?php

namespace back\Catalog\controllers;

use app\models\Entity;
use app\models\Category;
use app\repositories\CategoriesRepository;
use back\Catalog\forms\CategoryForm;
use back\controllers\CrudController;
use yii\web\Response;

class CategoriesController extends CrudController {

    /**
     * @inheritdoc
     */
    protected function actionIndexGET() {
        $id = $this->getEntityId();
        if(!empty($id)) {
            return parent::actionIndexGET();

        }
        $data = [];
        $categories = $this->getEntityRepository()->findFirstLevelCategories();
        foreach($categories as $category) {
            $data[] = $this->getCategoryData($category);
        }
        return $this->getResponse($data);
    }

    /**
     * @param Category $category
     * @return array
     */
    public function getCategoryData(Category $category) {
        $data = [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'children' => [

            ],
        ];
        foreach($category->getChildren() as $child) {
            $data['children'][] = $this->getCategoryData($child);
        }
        return $data;
    }

    public function actionSort() {
        $data = $this->getRequestBodyJSON();
        $parentId = !empty($data['parentId']) ? $data['parentId'] : null;
        if(!isset($data['categoriesIds']) || !is_array($data['categoriesIds'])) {
            return $this->getResponse('bad', Response::FORMAT_RAW, 400);
        }
        /** @var Category|null $parent */
        $parent = !empty($parentId) ? $this->getEntityRepository()->find($parentId) : null;
        $em = $this->getEntityManager();
        foreach($data['categoriesIds'] as $i => $categoryId) {
            /** @var Category|null $category */
            $category = !empty($categoryId) ? $this->getEntityRepository()->find($categoryId) : null;
            if(empty($category)) {
                continue;
            }
            $em->persist($category);
            $category->setParent($parent);
            $category->setSort($i);
        }
        $em->flush();
        return $this->getResponse('ok');
    }

    /** @inheritdoc */
    protected function createEntityForm() {
        return new CategoryForm();
    }

    /**
     * @inheritdoc
     * @return CategoriesRepository
     */
    protected function getEntityRepository() {
        return CategoriesRepository::getInstance();
    }

    /**
     * @inheritdoc
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [];
    }

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageCatalog();
    }

}