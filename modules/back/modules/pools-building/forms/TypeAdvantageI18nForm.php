<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\TypeAdvantage;
use app\models\TypeAdvantageI18n;
use back\forms\I18nForm;

class TypeAdvantageI18nForm extends I18nForm {

    public $text = '';

    protected $saveI18n = true;

    public function rules() {
        $rules = [
            ['text', 'required', 'message' => 'Укажите текст', 'when' => function(TypeAdvantageI18nForm $form) {
                return $form->getSaveI18n();
            }],
        ];
        return $rules;
    }

    /**
     * @inheritdoc
     * @return TypeAdvantageI18n Новая i18n
     */
    public function createNewI18n() {
        return new TypeAdvantageI18n();
    }

    /**
     * @inheritdoc
     * @param TypeAdvantageI18n $i18n
     * @param TypeAdvantage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setAdvantage($entity);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param TypeAdvantageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->text = $i18n->getText();
    }

}