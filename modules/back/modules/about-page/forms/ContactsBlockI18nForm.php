<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\AboutPage;
use app\models\AboutPageI18n;
use back\forms\I18nForm;

class ContactsBlockI18nForm extends I18nForm {

    public $menuName = '';
    public $title = '';
    protected $saveI18n = true;

    /** @inheritdoc */
    public function rules() {
        return [
            ['menuName', 'required', 'message' => 'Укажите название в меню'],
            ['title', 'required', 'message' => 'Укажите заголовок'],
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
        $i18n->setContactsMenuName($this->menuName);
        $i18n->setContactsTitle($this->title);
        return true;
    }

    /**
     * @inheritdoc
     * @param AboutPageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->menuName = $i18n->getContactsMenuName();
        $this->title = $i18n->getContactsTitle();
    }

    /**
     * @inheritdoc
     * @param AboutPageI18n $i18n
     */
    public function getDataFromI18n(I18n $i18n) {
        return [

        ];
    }

}