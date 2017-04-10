<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\PoolType;
use app\models\PoolTypeI18n;
use back\forms\I18nForm;
use back\helpers\HandyFile;
use back\validators\FormFileValidator;

class PoolTypeI18nForm extends I18nForm {

    public $name = '';
    public $description = '';
    /** @var HandyFile|null */
    public $stages = null;
    public $pageTitle = '';
    public $pageMetaKeywords = '';
    public $pageMetaDescription = '';

    /** @var PoolTypeI18n|null */
    private $i18n = null;

    public function rules() {
        $rules = [
            [['name', 'pageTitle'], 'required', 'message' => 'Заполните поле', 'when' => function(PoolTypeI18nForm $form) {
                return $form->getSaveI18n();
            }],
            [['description', 'pageMetaKeywords', 'pageMetaDescription'], 'safe'],
            ['description', 'safe'],
            ['stages', FormFileValidator::className(), 'required' => false, 'getCurrentFilePath' => function() {
                if(empty($this->i18n)) {
                    return null;
                }
                return $this->i18n->getStagesPath();
            }]
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return PoolTypeI18n Новая i18n
     */
    public function createNewI18n() {
        return new PoolTypeI18n();
    }

    /**
     * @inheritdoc
     * @param PoolTypeI18n $i18n
     * @param PoolType $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setType($entity);
        $i18n->setName($this->name);
        $i18n->setDescription($this->description);
        $i18n->setPageTitle($this->pageTitle);
        $i18n->setPageMetaKeywords($this->pageMetaKeywords);
        $i18n->setPageMetaDescription($this->pageMetaDescription);

        if(!empty($this->stages)) {
            $path = $this->stages->saveToDir('/files/pool-types');
            if(empty($path)) {
                $this->addError('stages', 'Не удалось сохранить файл');
                return false;
            }
            HandyFile::deleteFile($i18n->getStagesPath());
            $i18n->setStagesPath($path);
        }

        return true;
    }

    /**
     * @inheritdoc
     * @param PoolTypeI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->i18n = $i18n;
        $this->name = $i18n->getName();
        $this->description = $i18n->getDescription();
        $this->pageTitle = $i18n->getPageTitle();
        $this->pageMetaKeywords = $i18n->getPageMetaKeywords();
        $this->pageMetaDescription = $i18n->getPageMetaDescription();
    }

    public function load($data, $formName = null) {
        if(!parent::load($data, $formName)) {
            return false;
        }
        if(!empty($data['stagesUrl']) && !empty($data['stagesName'])) {
            $this->stages = HandyFile::createFromDataUrl($data['stagesUrl'], $data['stagesName']);
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param PoolTypeI18n $i18n
     */
    public function getDataFromI18n(I18n $i18n) {
        return [
            'stagesUrl' => $i18n->getStagesPath(),
        ];
    }

}