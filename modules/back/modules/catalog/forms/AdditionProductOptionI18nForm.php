<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\AdditionProductOption;
use app\models\AdditionProductOptionI18n;
use back\forms\I18nForm;

class AdditionProductOptionI18nForm extends I18nForm {

    public $name = '';
    public $value = '';
    protected $saveI18n = true;

    public function rules() {
        return [
            [['name', 'value'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     * @param AdditionProductOptionI18n $i18n
     * @param AdditionProductOption $entity
     * @return boolean
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setOption($entity);
        $i18n->setName($this->name);
        $i18n->setValue($this->value);
        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionProductOptionI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
        $this->value = $i18n->getValue();
    }

    /**
     * @return I18n Новая i18n
     */
    public function createNewI18n() {
        return new AdditionProductOptionI18n();
    }
}