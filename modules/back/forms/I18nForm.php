<?php

namespace back\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\Language;
use yii\base\Model;

/**
 * Форма для редактирования i18n
 */
abstract class I18nForm extends Form {

    /** @var boolean */
    protected $saveI18n = false;

    /** @var Language */
    private $language;

    /** @var I18n|null */
    private $i18n = null;

    /** @inheritdoc */
    public function rules() {
        return [
            ['saveI18n', 'boolean'],
        ];
    }

    /** @return Language */
    public final function getLanguage() { return $this->language; }

    /** @param Language $language */
    public final function setLanguage($language) { $this->language = $language; }

    /** @return I18n|null */
    public final function getI18n() {
        return $this->i18n;
    }

    public final function setI18n(I18n $i18n) {
        $this->i18n = $i18n;
        $this->saveI18n = true;
        $this->populateFromI18n($i18n);
    }

    /**
     * @return array
     */
    public final function getData() {
        $data = $this->getAttributes();
        if(empty($this->i18n)) {
            return $data;
        }
        return $data + $this->getDataFromI18n($this->i18n);
    }




    /**
     * @return I18n Новая i18n
     */
    public abstract function createNewI18n();

    /**
     * @param I18n $i18n
     * @param Entity $entity
     * @return boolean
     */
    public abstract function fillI18n(I18n $i18n, Entity $entity);

    /**
     * @return boolean
     * */
    public function getSaveI18n() { return $this->saveI18n; }

    /**
     * @param boolean $saveI18n
     */
    public function setSaveI18n($saveI18n) { $this->saveI18n = $saveI18n; }

    /**
     * @param I18n $i18n
     * @return array
     */
    public function getDataFromI18n(I18n $i18n) {
        return [];
    }

    /**
     * @param I18n $i18n
     */
    public abstract function populateFromI18n(I18n $i18n);

}