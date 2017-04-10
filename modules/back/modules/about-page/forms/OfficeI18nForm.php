<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\Office;
use app\models\OfficeI18n;
use back\forms\I18nForm;

class OfficeI18nForm extends I18nForm {

    public $name = '';
    public $address = '';
    public $phoneComment = '';
    public $email = '';
    public $comment = '';

    public function rules() {
        $rules = [
            ['email', 'email'],
            [['address', 'name', 'email'], 'required', 'message' => 'Заполните поле', 'when' => function(OfficeI18nForm $form) {
                return $form->getSaveI18n();
            }],
            [['phoneComment', 'comment'], 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return OfficeI18n Новая i18n
     */
    public function createNewI18n() {
        return new OfficeI18n();
    }

    /**
     * @inheritdoc
     * @param OfficeI18n $i18n
     * @param Office $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setOffice($entity);
        $i18n->setName($this->name);
        $i18n->setAddress($this->address);
        $i18n->setPhoneComment($this->phoneComment);
        $i18n->setEmail($this->email);
        $i18n->setComment($this->comment);
        return true;
    }

    /**
     * @inheritdoc
     * @param OfficeI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
        $this->address = $i18n->getAddress();
        $this->phoneComment = $i18n->getPhoneComment();
        $this->email = $i18n->getEmail();
        $this->comment = $i18n->getComment();
    }

}