<?php

namespace back\Publications\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\Publication;
use app\models\PublicationI18n;
use back\forms\I18nForm;

abstract class PublicationI18nForm extends I18nForm {

    public $name = '';
    public $shortDescription = '';
    public $description = '';
    public $pageTitle = '';
    public $pageMetaKeywords = '';
    public $pageMetaDescription = '';

    public function rules() {
        return array_merge(parent::rules(), [
            [['description', 'pageTitle', 'pageMetaKeywords', 'pageMetaDescription'], 'safe'],
            [['name', 'shortDescription'], 'required', 'message' => 'Заполните поле', 'when' => function(PublicationI18nForm $form) {
                return $form->getSaveI18n();
            }],
        ]);
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
     * @param PublicationI18n $i18n
     * @param Publication $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setPublication($entity);
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
     * @param PublicationI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
        $this->shortDescription = $i18n->getShortDescription();
        $this->description = $i18n->getDescription();
        $this->pageTitle = $i18n->getPageTitle();
        $this->pageMetaKeywords = $i18n->getPageMetaKeywords();
        $this->pageMetaDescription = $i18n->getPageMetaDescription();
    }

}