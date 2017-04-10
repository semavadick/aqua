<?php

namespace back\Catalog\forms;

use app\models\AdditionCategory;
use app\models\CategoryFilter;
use app\models\Entity;
use back\forms\EntityForm;
use back\validators\FormImageValidator;

class AdditionCategoryForm extends EntityForm {


    public $image;
    public $bg;
    public $relatedCategoriesIds = [];
    public $parentId = null;
    public $hasDiscount = null;

    /** @var AdditionCategory|null */
    private $category = null;

    /** @var FilterForm[] */
    private $filterForms = [];

    /** @var CategoryFilter[] */
    private $filtersToDelete = [];

    public function rules() {
        $rules = [
            ['image', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->category) ? $this->category->getImagePath() : null;
            }],
            ['bg', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->category) ? $this->category->getBgPath() : null;
            }],
            ['relatedCategoriesIds', 'safe'],
            ['parentId', 'safe'],
            ['hasDiscount', 'boolean'],
        ];
        return $rules;
    }

    /**
     * @inheritdoc
     * @param AdditionCategory $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->category = $entity;
        $this->relatedCategoriesIds = [];
        $this->hasDiscount = $entity->getHasDiscount();
        foreach($entity->getRelatedCategories() as $category) {
            $this->relatedCategoriesIds[] = $category->getId();
        }
        foreach($entity->getFilters() as $filter) {
            $this->filtersToDelete[$filter->getId()] = $filter;
            $form = new FilterForm();
            $form->setEntity($filter);
            $this->filterForms[] = $form;
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionCategory $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        $data = [
            'imageUrl' => $entity->getImagePath(),
            'bgUrl' => $entity->getSmallBgPath(),
            'filters' => [

            ],
        ];
        foreach($this->filterForms as $form) {
            $data['filters'][] = $form->getData();
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function load($data, $formName = '') {
        if(!parent::load($data, $formName)) {
            return false;
        }

        if(empty($data['filters']) || !is_array($data['filters'])) {
            return false;
        }
        foreach($data['filters'] as $filterData) {
            $filterForm = null;
            if(!empty($filterData['id'])) {
                foreach($this->filterForms as $form) {
                    if($form->id == $filterData['id']) {
                        $filterForm = $form;
                        unset($this->filtersToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($filterForm)) {
                $filterForm = new FilterForm();
                $this->filterForms[] = $filterForm;
            }
            $filterForm->load($filterData, '');
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionCategory $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setHasDiscount($this->hasDiscount);
        $imageResult = $this->saveImage('image', '/images/categories', $entity->getImagePath(), function($path) use($entity) {
            $entity->setImagePath($path);
        }, null, null, $entity::IMAGE_MAX_WIDTH, $entity::IMAGE_MAX_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        $imageResult = $this->saveImage('bg', '/images/categories', $entity->getBgPath(), function($path) use($entity) {
            $entity->setBgPath($path);
        }, $entity::BG_WIDTH, $entity::BG_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        $imageResult = $this->saveImage('bg', '/images/categories', $entity->getSmallBgPath(), function($path) use($entity) {
            $entity->setSmallBgPath($path);
        }, $entity::SMALL_BG_WIDTH, $entity::SMALL_BG_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        /** @var AdditionCategory[] $relatedCategories */
        $relatedCategories = $this->getEntityManager()->getRepository('Models:AdditionCategory')->findBy([
            'id' => $this->relatedCategoriesIds,
        ]);
        $entity->setRelatedCategories($relatedCategories);

        if(empty($this->category)) {
            /** @var AdditionCategory|null $parent */
            $parent = !empty($this->parentId) ? $this->getEntityManager()->find('Models:AdditionCategory', $this->parentId) : null;
            $entity->setParent($parent);
        }

        foreach($this->filterForms as $filterForm) {
            $filter = null;
            if(!empty($filterForm->id)) {
                foreach($entity->getFilters() as $categoryFilter) {
                    if($categoryFilter->getId() == $filterForm->id) {
                        $filter = $categoryFilter;
                        break;
                    }
                }
            }
            if(empty($filter)) {
                $filter = new CategoryFilter();
                $filter->setCategory($entity);
            }
            $this->getEntityManager()->persist($filter);
            $filterForm->fillEntity($filter);
        }

        foreach($this->filtersToDelete as $filter) {
            $this->getEntityManager()->remove($filter);
        }

        return true;
    }

    /**
     * @inheritdoc
     * @return Category
     */
    protected function createNewEntity() {
        return new AdditionCategory();
    }

    /**
     * @inheritdoc
     */
    protected function createNewI18nForm() {
        return new AdditionCategoryI18nForm();
    }

}