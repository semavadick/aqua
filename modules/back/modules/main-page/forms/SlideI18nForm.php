<?php

namespace back\MainPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\MainPageSlide;
use app\models\MainPageSlideI18n;
use back\forms\I18nForm;

class SlideI18nForm extends I18nForm {

    public $text = '';
    public $link = '';

    public function rules() {
        $rules = [
            [['link', 'text'], 'safe'],
            ['link', 'required', 'message' => 'Укажите ссылку', 'when' => function(SlideI18nForm $form) {
                return $form->getSaveI18n();
            }]
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return MainPageSlideI18n Новая i18n
     */
    public function createNewI18n() {
        return new MainPageSlideI18n();
    }

    /**
     * @inheritdoc
     * @param MainPageSlideI18n $i18n
     * @param MainPageSlide $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setSlide($entity);
        $i18n->setLink($this->link);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param MainPageSlideI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->link = $i18n->getLink();
        $this->text = $i18n->getText();
    }

}