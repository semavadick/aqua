<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\TypeAdvantage;
use back\forms\EntityForm;
use back\helpers\MagicImage;
use back\validators\FormImageValidator;

class TypeAdvantageForm extends EntityForm {

    public $id = null;
    public $icon;

    /** @var TypeAdvantage|null */
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
     * @param TypeAdvantage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->advantage = $entity;
        $this->id = $entity->getId();
        return true;
    }

    /**
     * @inheritdoc
     * @param TypeAdvantage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'iconUrl' => $entity->getIconUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param TypeAdvantage $entity
     */
    protected function fillEntity(Entity $entity) {
        $imageResult = $this->saveImage('icon', '/images/pool-types', $entity->getIconPath(), function($path) use($entity) {
            $entity->setIconPath($path);
        }, null, null, $entity::MAX_ICON_WIDTH, $entity::MAX_ICON_HEIGHT);
        if(!$imageResult) {
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
     * @return TypeAdvantage
     */
    protected function createNewEntity() {
        return new TypeAdvantage();
    }

    /**
     * @inheritdoc
     * @return TypeAdvantageI18nForm
     */
    protected function createNewI18nForm() {
        return new TypeAdvantageI18nForm();
    }
}