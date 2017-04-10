<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\PoolsBuildingStatic;
use app\models\PoolsBuildingStaticI18n;
use back\forms\I18nForm;

abstract class PoolsBuildingStaticI18nForm extends I18nForm {

    public $name = '';
    public $description = '';
    public $shortDescription = '';
    public $pageTitle = '';
    public $pageMetaKeywords = '';
    public $pageMetaDescription = '';

    public function rules() {
        return array_merge(parent::rules(), [
            [['description', 'shortDescription', 'pageTitle', 'pageMetaKeywords', 'pageMetaDescription'], 'safe'],
            [['name'], 'required', 'message' => 'Заполните поле', 'when' => function(PoolsBuildingStaticI18nForm $form) {
                return $form->getSaveI18n();
            }],
        ]);
    }

    /**
     * @inheritdoc
     * @return PoolsBuildingStaticI18n Новая i18n
     */
    public function createNewI18n() {
        return new PoolsBuildingStaticI18n();
    }

    public function beforeValidate() {
        if(!parent::beforeValidate()) {
            return false;
        }
        if(empty($this->pageTitle)) {
            $this->pageTitle = $this->name;
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingStaticI18n $i18n
     * @param PoolsBuildingStatic $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setPoolsBuildingStatic($entity);
        $i18n->setName($this->name);
        $i18n->setShortDescription($this->shortDescription);
        $i18n->setDescription($this->description);
        $i18n->setPageTitle($this->pageTitle);
        $i18n->setPageMetaKeywords($this->pageMetaKeywords);
        $i18n->setPageMetaDescription($this->pageMetaDescription);
        return true;
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingStaticI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        //$this->i18n = $i18n;
        $this->name = $i18n->getName();
        $this->shortDescription = $i18n->getShortDescription();
        $this->description = $i18n->getDescription();
        $this->pageTitle = $i18n->getPageTitle();
        $this->pageMetaKeywords = $i18n->getPageMetaKeywords();
        $this->pageMetaDescription = $i18n->getPageMetaDescription();
    }

}