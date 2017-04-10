<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\AboutPage;
use app\models\AboutPageI18n;
use back\forms\I18nForm;
use back\helpers\MagicImage;

class HistoryI18nForm extends I18nForm {

    public $image = '';
    protected $saveI18n = true;

    /** @inheritdoc */
    public function rules() {
        return [
            ['image', 'checkImage', 'skipOnEmpty' => false],
        ];
    }

    /** @var AboutPageI18n */
    private $i18nInstance = null;

    public function checkImage($attribute, $params) {
        $currentImageUrl = !empty($this->i18nInstance) ? $this->i18nInstance->getHistoryImageUrl() : null;
        if(empty($this->image) && empty($currentImageUrl)) {
            $this->addError($attribute, 'Выберите изображение');
        }
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
        if(empty($this->image)) {
            return true;
        }
        $image = MagicImage::createFromDataUrl($this->image);
        if(empty($image)) {
            $this->addError('image', 'Не удалось загрузить изображение');
            return false;
        }
        $imagePath = $image->saveToDir('/images/about');
        if(empty($imagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }
        MagicImage::deleteImage($i18n->getHistoryImagePath());
        $i18n->setHistoryImagePath($imagePath);

        return true;
    }

    /**
     * @inheritdoc
     * @param AboutPageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->i18nInstance = $i18n;
    }

    /**
     * @inheritdoc
     * @param AboutPageI18n $i18n
     */
    public function getDataFromI18n(I18n $i18n) {
        return [
            'imageUrl' => $i18n->getHistoryImageUrl(),
        ];
    }

}