<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\OfficeRegion;
use app\models\OfficeRegionI18n;
use back\forms\I18nForm;

class OfficeRegionI18nForm extends I18nForm {

    public $name = '';

    public function rules() {
        $rules = [
            ['name', 'required', 'message' => 'Укажите название', 'when' => function(OfficeRegionI18nForm $form) {
                return $form->getSaveI18n();
            }]
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return OfficeRegionI18n Новая i18n
     */
    public function createNewI18n() {
        return new OfficeRegionI18n();
    }

    /**
     * @inheritdoc
     * @param OfficeRegionI18n $i18n
     * @param OfficeRegion $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setRegion($entity);
        $i18n->setName($this->name);
        return true;
    }

    /**
     * @inheritdoc
     * @param OfficeRegionI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
    }

}