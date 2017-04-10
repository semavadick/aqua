<?php

namespace back\Publications\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\PublicationGalleryImage;
use app\models\PublicationGalleryImageI18n;
use back\forms\I18nForm;

abstract class PublicationGalleryImageI18nForm extends I18nForm {

    public $name = '';

    public function rules() {
        return [
            ['name', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     * @param PublicationGalleryImageI18n $i18n
     * @param PublicationGalleryImage $entity
     * @return boolean
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setImage($entity);
        $i18n->setName($this->name);
    }

    /**
     * @inheritdoc
     * @param PublicationGalleryImageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
    }

}