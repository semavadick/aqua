<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\AboutPage;
use app\models\AboutPageI18n;
use back\forms\I18nForm;

class SeoI18nForm extends I18nForm {

    public $title = '';
    public $metaKeywords = '';
    public $metaDescription = '';
    protected $saveI18n = true;

    /** @inheritdoc */
    public function rules() {
        return [
            ['title', 'required'],
            [['title', 'metaKeywords'], 'string', 'max' => 255],
            ['metaDescription', 'string', 'max' => 1022],
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
        $i18n->setTitle($this->title);
        $i18n->setMetaKeywords($this->metaKeywords);
        $i18n->setMetaDescription($this->metaDescription);
        return true;
    }

    /**
     * @inheritdoc
     * @param AboutPageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->title = $i18n->getTitle();
        $this->metaKeywords = $i18n->getMetaKeywords();
        $this->metaDescription = $i18n->getMetaDescription();
    }
}