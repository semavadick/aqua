<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\Certificate;
use app\models\CertificateI18n;
use back\forms\I18nForm;

class CertificateI18nForm extends I18nForm {

    public $name = '';

    public function rules() {
        $rules = [
            ['name', 'required', 'message' => 'Укажите название', 'when' => function(CertificateI18nForm $form) {
                return $form->getSaveI18n();
            }]
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return CertificateI18n Новая i18n
     */
    public function createNewI18n() {
        return new CertificateI18n();
    }

    /**
     * @inheritdoc
     * @param CertificateI18n $i18n
     * @param Certificate $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setCertificate($entity);
        $i18n->setName($this->name);
        return true;
    }

    /**
     * @inheritdoc
     * @param CertificateI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->name = $i18n->getName();
    }

}