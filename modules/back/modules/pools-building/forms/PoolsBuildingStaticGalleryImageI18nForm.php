<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\PoolsBuildingStaticGalleryImage;
use app\models\PoolsBuildingStaticGalleryImageI18n;
use back\forms\I18nForm;

abstract class PoolsBuildingStaticGalleryImageI18nForm extends I18nForm {

    public $name = '';

    public function rules() {
        return [
            ['name', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingStaticGalleryImageI18n $i18n
     * @param PoolsBuildingStaticGalleryImage $entity
     * @return boolean
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setImage($entity);
        $i18n->setName($this->name);
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingStaticGalleryImageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
    }

}