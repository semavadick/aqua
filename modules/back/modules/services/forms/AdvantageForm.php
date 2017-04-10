<?php

namespace back\Services\forms;

use app\models\Entity;
use app\models\ServiceAdvantage;
use back\forms\EntityForm;
use back\validators\FormImageValidator;

class AdvantageForm extends EntityForm {

    public $id = null;
    public $icon;

    /** @var ServiceAdvantage|null */
    private $advantage = null;

    public function rules() {
        return [
            ['icon', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->advantage) ? $this->advantage->getIconPath() : null;
            }],
        ];
    }

    /**
     * @inheritdoc
     * @param ServiceAdvantage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->id = $entity->getId();
        $this->advantage = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param ServiceAdvantage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'iconUrl' => $entity->getIconUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param ServiceAdvantage $entity
     */
    protected function fillEntity(Entity $entity) {
        $imageResult = $this->saveImage('icon', '/images/services', $entity->getIconPath(), function($path) use($entity) {
            $entity->setIconPath($path);
        }, null, null, $entity::MAX_ICON_WIDTH, $entity::MAX_ICON_HEIGHT);
        if(!$imageResult) {
            $this->addError('icon', 'Не удалось загрузить изображение');
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
     * @return ServiceAdvantage
     */
    protected function createNewEntity() {
        return new ServiceAdvantage();
    }

    /**
     * @inheritdoc
     * @return AdvantageI18nForm
     */
    protected function createNewI18nForm() {
        return new AdvantageI18nForm();
    }

}