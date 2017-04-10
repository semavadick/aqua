<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\ProductionImage;
use app\models\ProductionImageI18n;
use back\forms\I18nForm;

class ProductionImageI18nForm extends I18nForm {

    public $text = '';

    public function rules() {
        $rules = [
            ['text', 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return ProductionImageI18n Новая i18n
     */
    public function createNewI18n() {
        return new ProductionImageI18n();
    }

    /**
     * @inheritdoc
     * @param ProductionImageI18n $i18n
     * @param ProductionImage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setProductionImage($entity);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param ProductionImageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->text = $i18n->getText();
    }

}