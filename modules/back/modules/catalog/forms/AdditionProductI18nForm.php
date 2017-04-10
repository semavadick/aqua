<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\AdditionProduct;
use app\models\AdditionProductI18n;
use back\forms\I18nForm;

class AdditionProductI18nForm extends I18nForm {

    public $name = '';
    public $description = '';
    public $pageTitle = '';
    public $pageMetaKeywords = '';
    public $pageMetaDescription = '';

    public function rules() {
        $rules = [
            [['name', 'pageTitle'], 'required', 'message' => 'Заполните поле', 'when' => function(AdditionProductI18nForm $form) {
                return $form->getSaveI18n();
            }],
            [['description', 'pageMetaKeywords', 'pageMetaDescription'], 'safe'],
            ['description', 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return AdditionProductI18n Новая i18n
     */
    public function createNewI18n() {
        return new AdditionProductI18n();
    }

    /**
     * @inheritdoc
     * @param AdditionProductI18n $i18n
     * @param AdditionProduct $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setProduct($entity);
        $i18n->setName($this->name);
        $i18n->setDescription($this->description);
        $i18n->setPageTitle($this->pageTitle);
        $i18n->setPageMetaKeywords($this->pageMetaKeywords);
        $i18n->setPageMetaDescription($this->pageMetaDescription);
        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionProductI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
        $this->description = $i18n->getDescription();
        $this->pageTitle = $i18n->getPageTitle();
        $this->pageMetaKeywords = $i18n->getPageMetaKeywords();
        $this->pageMetaDescription = $i18n->getPageMetaDescription();
    }

}