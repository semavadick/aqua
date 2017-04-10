<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\HistoryStage;
use app\models\HistoryStageI18n;
use back\forms\I18nForm;

class HistoryStageI18nForm extends I18nForm {

    public $text = '';

    public function rules() {
        $rules = [
            ['text', 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return HistoryStageI18n Новая i18n
     */
    public function createNewI18n() {
        return new HistoryStageI18n();
    }

    /**
     * @inheritdoc
     * @param HistoryStageI18n $i18n
     * @param HistoryStage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setStage($entity);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param HistoryStageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->text = $i18n->getText();
    }

}