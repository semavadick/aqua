<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\CategoryFilter;
use app\models\CategoryFilterI18n;
use back\forms\I18nForm;

class FilterI18nForm extends I18nForm {

    public $text = '';

    protected $saveI18n = true;

    public function rules() {
        $rules = [
            ['text', 'safe'],
        ];
        return $rules;
    }

    /**
     * @inheritdoc
     * @return CategoryFilterI18n Новая i18n
     */
    public function createNewI18n() {
        return new CategoryFilterI18n();
    }

    /**
     * @inheritdoc
     * @param CategoryFilterI18n $i18n
     * @param CategoryFilter $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setFilter($entity);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param CategoryFilterI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->text = $i18n->getText();
    }

}