<?php

namespace back\Services\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\ServiceType;
use app\models\ServiceTypeI18n;
use back\forms\I18nForm;

class TypeI18nForm extends I18nForm {

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
     * @return ServiceTypeI18n Новая i18n
     */
    public function createNewI18n() {
        return new ServiceTypeI18n();
    }

    /**
     * @inheritdoc
     * @param ServiceTypeI18n $i18n
     * @param ServiceType $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setType($entity);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param ServiceTypeI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->text = $i18n->getText();
    }

}