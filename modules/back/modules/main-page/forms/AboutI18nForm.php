<?php

namespace back\MainPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\MainPage;
use app\models\MainPageI18n;
use back\forms\I18nForm;

class AboutI18nForm extends I18nForm {

    public $title = '';
    public $text = '';
    public $video = '';
    protected $saveI18n = true;

    /** @inheritdoc */
    public function rules() {
        return [
            ['title', 'required', 'message' => 'Укажите заголовок'],
            [['text', 'video'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     * @return MainPageI18n
     */
    public function createNewI18n() {
        return new MainPageI18n();
    }

    /**
     * @inheritdoc
     * @param MainPageI18n $i18n
     * @param MainPage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setAboutTitle($this->title);
        $i18n->setAboutText($this->text);
        $i18n->setAboutVideo($this->video);
        return true;
    }

    /**
     * @inheritdoc
     * @param MainPageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->title = $i18n->getAboutTitle();
        $this->text = $i18n->getAboutText();
        $this->video = $i18n->getAboutVideo();
    }
}