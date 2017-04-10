<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\Attachment;
use back\forms\EntityForm;
use back\validators\FormImageValidator;

class AttachmentForm extends EntityForm {

    public $icon;

    /** @var Attachment|null */
    private $attachment = null;

    public function rules() {
        return [
            ['icon', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->attachment) ? $this->attachment->getIconPath() : null;
            }],
        ];
    }

    /**
     * @inheritdoc
     * @param Attachment $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->attachment = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param Attachment $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'iconUrl' => $entity->getIconPath(),
        ];
    }

    /**
     * @inheritdoc
     * @param Attachment $entity
     */
    protected function fillEntity(Entity $entity) {
        $imageResult = $this->saveImage('icon', '/images/catalog/attachments', $entity->getIconPath(), function($path) use($entity) {
            $entity->setIconPath($path);
        }, null, null, $entity::MAX_ICON_WIDTH, $entity::MAX_ICON_HEIGHT);
        if(!$imageResult) {
            $this->addError('icon', 'Не удалось загрузить изображение');
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     * @return Attachment
     */
    protected function createNewEntity() {
        return new Attachment();
    }

    /**
     * @inheritdoc
     * @return AttachmentI18nForm
     */
    protected function createNewI18nForm() {
        return new AttachmentI18nForm();
    }
}