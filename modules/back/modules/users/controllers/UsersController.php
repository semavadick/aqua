<?php

namespace back\Users\controllers;

use app\models\Category;
use app\models\AdditionCategory;
use app\models\Entity;
use app\models\User;
use app\repositories\CategoriesRepository;
use app\repositories\AdditionCategoriesRepository;
use app\repositories\UsersRepository;
use back\controllers\TableCrudController;
use back\Users\forms\UserForm;
use back\Users\forms\UsersSearchForm;

class UsersController extends TableCrudController {

    public function actionDiscountCategories() {
        $data = [];
        $categories = CategoriesRepository::getInstance()->findFirstLevelCategories();
        $additionCategories = AdditionCategoriesRepository::getInstance()->findFirstLevelCategories();
        $userId = \Yii::$app->getRequest()->get('id');
        /** @var User|null $user */
        $user = !empty($userId) ? $this->getEntityRepository()->find($userId) : null;
        foreach($categories as $category) {
            if($category->getHasDiscount() || $category->hasChildWithDiscount()) {
                $data['main'][] = $this->getCategoryData($category, $user);
            }
        }

        foreach($additionCategories as $category) {
            if($category->getHasDiscount() || $category->hasChildWithDiscount()) {
                $data['addition'][] = $this->getAdditionCategoryData($category, $user);
            }
        }

        return $this->getResponse($data);
    }

    /**
     * @param User|null $user
     * @param Category $category
     * @return array
     */
    public function getCategoryData(Category $category, User $user = null) {
        $data = [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'hasDiscount' => $category->getHasDiscount(),
            'discount' => !empty($user) ? $user->getDiscountForCategory($category) : null,
            'children' => [

            ],
        ];
        foreach($category->getChildren() as $child) {
            if($child->getHasDiscount() || $child->hasChildWithDiscount()) {
                $data['children'][] = $this->getCategoryData($child, $user);
            }
        }
        return $data;
    }

    /**
     * @param User|null $user
     * @param AdditionCategory $category
     * @return array
     */
    public function getAdditionCategoryData(AdditionCategory $category, User $user = null) {
        $data = [
            'id' => $category->getId(),
            'name' => $category->getName(),
            'hasDiscount' => $category->getHasDiscount(),
            'discount' => !empty($user) ? $user->getDiscountForAdditionCategory($category) : null,
            'children' => [

            ],
        ];
        foreach($category->getChildren() as $child) {
            if($child->getHasDiscount() || $child->hasChildWithDiscount()) {
                $data['children'][] = $this->getAdditionCategoryData($child, $user);
            }
        }
        return $data;
    }

    /** @inheritdoc */
    protected function createEntityForm() {
        return new UserForm();
    }

    /**
     * @inheritdoc
     * @return UsersRepository
     */
    protected function getEntityRepository() {
        return UsersRepository::getInstance();
    }

    /**
     * @inheritdoc
     * @param User $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        $typeLabel = 'Физик';
        if($entity->getType() == $entity::TYPE_COMPANY) {
            $typeLabel = $entity->getCompanyTypeLabel();
        }
        $fileUrl = $entity->getCompanyInfoFilePath();
        return [
            'id' => $entity->getId(),
            'phone' => $entity->getPhone(),
            'email' => $entity->getEmail(),
            'fullName' => $entity->getFullName(),
            'companyName' => $entity->getCompanyName(),
            'type' => $typeLabel,
            'ordersCount' => $entity->getOrdersCount(),
            'companyInfoFileUrl' => "<a href='{$fileUrl}' target='_blank'>{$fileUrl}</a>",
        ];
    }

    /** @inheritdoc */
    protected function createSearchForm() {
        return new UsersSearchForm();
    }

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageUsers();
    }

}