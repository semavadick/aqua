<?php

namespace back\Services\forms;

use app\models\Entity;
use app\models\ServiceType;
use back\forms\EntityForm;
use back\validators\FormImageValidator;

class TypeForm extends EntityForm {

    public $id = null;
    public $image;

    /** @var ServiceType|null */
    private $type = null;

    public function rules() {
        return [
            ['image', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->type) ? $this->type->getImagePath() : null;
            }],
        ];
    }

    /**
     * @inheritdoc
     * @param ServiceType $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->id = $entity->getId();
        $this->type = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param ServiceType $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param ServiceType $entity
     */
    protected function fillEntity(Entity $entity) {
        $imageResult = $this->saveImage('image', '/images/services', $entity->getImagePath(), function($path) use($entity) {
            $entity->setImagePath($path);
        }, null, null, $entity::MAX_ICON_WIDTH, $entity::MAX_ICON_HEIGHT);
        if(!$imageResult) {
            $this->addError('image', 'Не удалось загрузить изображение');
            return false;
        }

        foreach($this->i18nForms as $i18nForm) {
            $i18n = $entity->getI18n($i18nForm->getLanguage());
            if(empty($i18n)) {
                $i18n = $i18nForm->createNewI18n();
                $i18n->setLanguage($i18nForm->getLanguage());
            }
            $i18nForm->fillI18n($i18n, $entity);
            $this->getEntityManager()->persist($i18n);
        }

        return true;
    }

    /**
     * @inheritdoc
     * @return ServiceType
     */
    protected function createNewEntity() {
        return new ServiceType();
    }

    /**
     * @inheritdoc
     * @return TypeI18nForm
     */
    protected function createNewI18nForm() {
        return new TypeI18nForm();
    }

}