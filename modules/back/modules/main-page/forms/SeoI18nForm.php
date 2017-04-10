<?php

namespace back\MainPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\MainPage;
use app\models\MainPageI18n;
use back\forms\I18nForm;
use back\helpers\HandyFile;
use back\validators\FormFileValidator;
use back\validators\FormImageValidator;

class SeoI18nForm extends I18nForm {

    public $title = '';
    public $metaKeywords = '';
    public $metaDescription = '';
    public $catalogImage = '';

    /** @var HandyFile|null */
    public $catalogFile;

    protected $saveI18n = true;

    /** @var MainPageI18n|null  */
    private $pageI18n = null;

    /** @inheritdoc */
    public function rules() {
        return [
            ['title', 'required'],
            [['title', 'metaKeywords'], 'string', 'max' => 255],
            ['metaDescription', 'string', 'max' => 1022],
            ['catalogImage', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->pageI18n) ? $this->pageI18n->getCatalogImagePath() : null;
            }],
            ['catalogFile', FormFileValidator::className(), 'getCurrentFilePath' => function() {
                return !empty($this->pageI18n) ? $this->pageI18n->getCatalogFilePath() : null;
            }]
        ];
    }

    public function load($data, $formName = null) {
        if(!parent::load($data, $formName)) {
            return false;
        }
        if(!empty($data['catalogFileUrl']) && !empty($data['catalogFileName'])) {
            $this->catalogFile = HandyFile::createFromDataUrl($data['catalogFileUrl'], $data['catalogFileName']);
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param MainPageI18n $i18n
     */
    public function getDataFromI18n(I18n $i18n) {
        return [
            'catalogImageUrl' => $i18n->getCatalogImagePath(),
            'catalogFileUrl' => $i18n->getCatalogFilePath(),
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
        $i18n->setTitle($this->title);
        $i18n->setMetaKeywords($this->metaKeywords);
        $i18n->setMetaDescription($this->metaDescription);

        if(!empty($this->catalogFile)) {
            $path = $this->catalogFile->saveToDir('/files/main-page');
            if(empty($path)) {
                $this->addError('catalogFile', 'Не удалось сохранить файл');
                return false;
            }
            HandyFile::deleteFile($i18n->getCatalogFilePath());
            $i18n->setCatalogFilePath($path);
        }

        $imageResult = $this->saveImage('catalogImage', '/images/main-page', $i18n->getCatalogImagePath(), function($path) use($i18n) {
            $i18n->setCatalogImagePath($path);
        }, $i18n::CATALOG_IMAGE_WIDTH, $i18n::CATALOG_IMAGE_HEIGHT);
        if(!$imageResult) {
            $this->addError('catalogImagePath', 'Не удалось загрузить изображение');
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     * @param MainPageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->pageI18n = $i18n;
        $this->title = $i18n->getTitle();
        $this->metaKeywords = $i18n->getMetaKeywords();
        $this->metaDescription = $i18n->getMetaDescription();
    }
}