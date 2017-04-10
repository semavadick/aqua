<?php

namespace back\ObjectGalleries\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\ObjectGallery;
use app\models\ObjectGalleryI18n;
use back\forms\I18nForm;

class ObjectGalleryI18nForm extends I18nForm {

    public $name = '';
    public $shortDescription = '';
    public $description = '';
    public $pageTitle = '';
    public $pageMetaKeywords = '';
    public $pageMetaDescription = '';
    public $address = '';

    /** @var ObjectGalleryI18n|null */
    private $i18n = null;

    public function rules() {
        $rules = [
            [['name', 'pageTitle', 'shortDescription', 'address'], 'required', 'message' => 'Заполните поле', 'when' => function(ObjectGalleryI18nForm $form) {
                return $form->getSaveI18n();
            }],
            [['description', 'pageMetaKeywords', 'pageMetaDescription'], 'safe'],
            ['description', 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return ObjectGalleryI18n Новая i18n
     */
    public function createNewI18n() {
        return new ObjectGalleryI18n();
    }

    /**
     * @inheritdoc
     * @param ObjectGalleryI18n $i18n
     * @param ObjectGallery $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setGallery($entity);
        $i18n->setName($this->name);
        $i18n->setShortDescription($this->shortDescription);
        $i18n->setDescription($this->description);
        $i18n->setPageTitle($this->pageTitle);
        $i18n->setPageMetaKeywords($this->pageMetaKeywords);
        $i18n->setPageMetaDescription($this->pageMetaDescription);
        $i18n->setAddress($this->address);
        return true;
    }

    /**
     * @inheritdoc
     * @param ObjectGalleryI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->i18n = $i18n;
        $this->name = $i18n->getName();
        $this->shortDescription = $i18n->getShortDescription();
        $this->description = $i18n->getDescription();
        $this->pageTitle = $i18n->getPageTitle();
        $this->pageMetaKeywords = $i18n->getPageMetaKeywords();
        $this->pageMetaDescription = $i18n->getPageMetaDescription();
        $this->address = $i18n->getAddress();
    }

}