<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\PoolsBuildingPage;
use app\models\PoolsBuildingPageI18n;
use back\forms\I18nForm;
use back\helpers\HandyFile;
use back\validators\FormFileValidator;

abstract class ServiceI18nForm extends I18nForm {

    public $title = '';
    public $text = '';

    /** @var HandyFile|null */
    public $presentation = null;

    /** @var PoolsBuildingPageI18n|null */
    private $i18n = null;

    public function rules() {
        return [
            ['title', 'required', 'message' => 'Укажите заголовок'],
            ['text', 'safe'],
            ['presentation', FormFileValidator::className(), 'getCurrentFilePath' => function() {
                return $this->getPresentationPath($this->i18n);
            }]
        ];
    }

    public abstract function getTitle(PoolsBuildingPageI18n $i18n);
    public abstract function setTitle(PoolsBuildingPageI18n $i18n, $title);
    public abstract function getText(PoolsBuildingPageI18n $i18n);
    public abstract function setText(PoolsBuildingPageI18n $i18n, $text);
    public abstract function getPresentationPath(PoolsBuildingPageI18n $i18n);
    public abstract function setPresentationPath(PoolsBuildingPageI18n $i18n, $path);

    public function load($data, $formName = null) {
        if(!parent::load($data, $formName)) {
            return false;
        }
        if(!empty($data['presentationUrl']) && !empty($data['presentationName'])) {
            $this->presentation = HandyFile::createFromDataUrl($data['presentationUrl'], $data['presentationName']);
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingPageI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->i18n = $i18n;
        $this->title = $this->getTitle($i18n);
        $this->text = $this->getText($i18n);
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingPageI18n $i18n
     * @param PoolsBuildingPage $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $this->setTitle($i18n, $this->title);
        $this->setText($i18n, $this->text);
        if(!empty($this->presentation)) {
            $path = $this->presentation->saveToDir('/files/pools-building');
            if(empty($path)) {
                $this->addError('presentation', 'Не удалось сохранить файл');
                return false;
            }
            HandyFile::deleteFile($this->getPresentationPath($i18n));
            $this->setPresentationPath($i18n, $path);
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingPageI18n $i18n
     */
    public function getDataFromI18n(I18n $i18n) {
        return [
            'presentationUrl' => $this->getPresentationPath($i18n),
        ];
    }

    /**
     * @inheritdoc
     * @return PoolsBuildingPageI18n
     */
    public function createNewI18n() {
        return new PoolsBuildingPageI18n();
    }

}