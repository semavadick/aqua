<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\FaqItem;
use app\models\FaqItemI18n;
use back\forms\I18nForm;

class FaqItemI18nForm extends I18nForm {

    public $question = '';
    public $answer = '';

    public function rules() {
        $rules = [
            ['question', 'required', 'message' => 'Укажите вопрос', 'when' => function(FaqItemI18nForm $form) {
                return $form->getSaveI18n();
            }],
            ['answer', 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return FaqItemI18n Новая i18n
     */
    public function createNewI18n() {
        return new FaqItemI18n();
    }

    /**
     * @inheritdoc
     * @param FaqItemI18n $i18n
     * @param FaqItem $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setItem($entity);
        $i18n->setQuestion($this->question);
        $i18n->setAnswer($this->answer);
        return true;
    }

    /**
     * @inheritdoc
     * @param FaqItemI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->question = $i18n->getQuestion();
        $this->answer = $i18n->getAnswer();
    }

}