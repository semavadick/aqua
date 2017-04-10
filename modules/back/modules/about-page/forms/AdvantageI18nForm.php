<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\Advantage;
use app\models\AdvantageI18n;
use back\forms\I18nForm;

class AdvantageI18nForm extends I18nForm {

    public $text = '';

    public function rules() {
        $rules = [
            ['text', 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return AdvantageI18n Новая i18n
     */
    public function createNewI18n() {
        return new AdvantageI18n();
    }

    /**
     * @inheritdoc
     * @param AdvantageI18n $i18n
     * @param Advantage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setAdvantage($entity);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param AdvantageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->text = $i18n->getText();
    }

}