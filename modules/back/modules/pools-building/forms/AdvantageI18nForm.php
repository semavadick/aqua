<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\TechAdvantage;
use app\models\TechAdvantageI18n;
use back\forms\I18nForm;

class AdvantageI18nForm extends I18nForm {

    public $tagline = '';
    public $text = '';

    public function rules() {
        $rules = [
            ['tagline', 'required', 'message' => 'Укажите слоган', 'when' => function(AdvantageI18nForm $form) {
                return $form->getSaveI18n();
            }],
            ['text', 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return TechAdvantageI18n Новая i18n
     */
    public function createNewI18n() {
        return new TechAdvantageI18n();
    }

    /**
     * @inheritdoc
     * @param TechAdvantageI18n $i18n
     * @param TechAdvantage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setAdvantage($entity);
        $i18n->setTagline($this->tagline);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param TechAdvantageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->tagline = $i18n->getTagline();
        $this->text = $i18n->getText();
    }

}