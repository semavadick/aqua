<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\AdditionProductTab;
use app\models\AdditionProductTabI18n;
use back\forms\I18nForm;

class AdditionProductTabI18nForm extends I18nForm {

    public $name = '';
    public $content = '';
    protected $saveI18n = true;

    public function rules() {
        return [
            [['name', 'content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     * @param AdditionProductTabI18n $i18n
     * @param AdditionProductTab $entity
     * @return boolean
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setTab($entity);
        $i18n->setName($this->name);
        $i18n->setContent($this->content);
        return true;
    }

    /**
     * @inheritdoc
     * @param AdditionProductTabI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
        $this->content = $i18n->getContent();
    }

    /**
     * @return I18n Новая i18n
     */
    public function createNewI18n() {
        return new AdditionProductTabI18n();
    }
}