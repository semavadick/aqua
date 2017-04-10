<?php

namespace back\Services\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\ServiceAdvantage;
use app\models\ServiceAdvantageI18n;
use back\forms\I18nForm;

class AdvantageI18nForm extends I18nForm {

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
     * @return ServiceAdvantageI18n Новая i18n
     */
    public function createNewI18n() {
        return new ServiceAdvantageI18n();
    }

    /**
     * @inheritdoc
     * @param ServiceAdvantageI18n $i18n
     * @param ServiceAdvantage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setAdvantage($entity);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param ServiceAdvantageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->text = $i18n->getText();
    }

}