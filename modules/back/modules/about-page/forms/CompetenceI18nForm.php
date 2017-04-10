<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\AboutPage;
use app\models\AboutPageI18n;
use back\forms\I18nForm;

class CompetenceI18nForm extends I18nForm {

    public $title = '';
    public $text = '';
    protected $saveI18n = true;

    /** @inheritdoc */
    public function rules() {
        return [
            ['title', 'required', 'message' => 'Укажите заголовок'],
            ['text', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     * @return AboutPageI18n
     */
    public function createNewI18n() {
        return new AboutPageI18n();
    }

    /**
     * @inheritdoc
     * @param AboutPageI18n $i18n
     * @param AboutPage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setCompetenceTitle($this->title);
        $i18n->setCompetenceText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param AboutPageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->title = $i18n->getCompetenceTitle();
        $this->text = $i18n->getCompetenceText();
    }

}