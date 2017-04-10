<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\Category;
use app\models\CategoryI18n;
use back\forms\I18nForm;
use yii\helpers\ArrayHelper;

class CategoryI18nForm extends I18nForm {

    public $name = '';
    public $description = '';
    public $pageTitle = '';
    public $pageMetaKeywords = '';
    public $pageMetaDescription = '';

    /** @var CategoryI18n|null */
    private $i18n = null;

    public function rules() {
        $rules = [
            [['name', 'pageTitle'], 'required', 'message' => 'Заполните поле', 'when' => function(CategoryI18nForm $form) {
                return $form->getSaveI18n();
            }],
            [['description', 'pageMetaKeywords', 'pageMetaDescription'], 'safe'],
            ['description', 'safe'],
        ];
        return ArrayHelper::merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return CategoryI18n Новая i18n
     */
    public function createNewI18n() {
        return new CategoryI18n();
    }

    /**
     * @inheritdoc
     * @param CategoryI18n $i18n
     * @param Category $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setCategory($entity);
        $i18n->setName($this->name);
        $i18n->setDescription($this->description);
        $i18n->setPageTitle($this->pageTitle);
        $i18n->setPageMetaKeywords($this->pageMetaKeywords);
        $i18n->setPageMetaDescription($this->pageMetaDescription);
        return true;
    }

    /**
     * @inheritdoc
     * @param CategoryI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->i18n = $i18n;
        $this->name = $i18n->getName();
        $this->description = $i18n->getDescription();
        $this->pageTitle = $i18n->getPageTitle();
        $this->pageMetaKeywords = $i18n->getPageMetaKeywords();
        $this->pageMetaDescription = $i18n->getPageMetaDescription();
    }

}