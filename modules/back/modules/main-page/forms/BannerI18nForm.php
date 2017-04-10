<?php

namespace back\MainPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\MainPageBanner;
use app\models\MainPageBannerI18n;
use back\forms\I18nForm;

class BannerI18nForm extends I18nForm {

    public $text = '';
    public $link = '';

    public function rules() {
        $rules = [
            [['link', 'text'], 'safe'],
            ['link', 'required', 'message' => 'Укажите ссылку', 'when' => function(BannerI18nForm $form) {
                return $form->getSaveI18n();
            }]
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return MainPageBannerI18n Новая i18n
     */
    public function createNewI18n() {
        return new MainPageBannerI18n();
    }

    /**
     * @inheritdoc
     * @param MainPageBannerI18n $i18n
     * @param MainPageBanner $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setBanner($entity);
        $i18n->setLink($this->link);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param MainPageBannerI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->link = $i18n->getLink();
        $this->text = $i18n->getText();
    }

}