<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\I18n;
use app\models\Attachment;
use app\models\AttachmentI18n;
use back\forms\I18nForm;

class AttachmentI18nForm extends I18nForm {

    public $text = '';

    public function rules() {
        $rules = [
            ['text', 'required', 'message' => 'Заполните поле', 'when' => function(AttachmentI18nForm $form) {
                return $form->getSaveI18n();
            }],
        ];
        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     * @return AttachmentI18n Новая i18n
     */
    public function createNewI18n() {
        return new AttachmentI18n();
    }

    /**
     * @inheritdoc
     * @param AttachmentI18n $i18n
     * @param Attachment $entity
     */
    public function fillI18n(I18n $i18n, Entity $entity) {
        $i18n->setAttachment($entity);
        $i18n->setText($this->text);
        return true;
    }

    /**
     * @inheritdoc
     * @param AttachmentI18n $i18n
     */
    public function populateFromI18n(I18n $i18n) {
        $this->text = $i18n->getText();
    }

}