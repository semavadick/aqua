<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\TechAdvantage;
use back\forms\EntityForm;
use back\helpers\MagicImage;
use back\validators\FormImageValidator;

class AdvantageForm extends EntityForm {

    public $icon;

    /** @var TechAdvantage|null */
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
     * @param TechAdvantage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->advantage = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param TechAdvantage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'iconUrl' => $entity->getIconUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param TechAdvantage $entity
     */
    protected function fillEntity(Entity $entity) {
        if(empty($this->icon)) {
            return true;
        }

        $image = MagicImage::createFromDataUrl($this->icon);
        if(empty($image)) {
            $this->addError('icon', 'Не удалось загрузить изображение');
            return false;
        }
        $image->resizeToMaxSize($entity::MAX_ICON_WIDTH, $entity::MAX_ICON_HEIGHT);
        $imagePath = $image->saveToDir('/images/tech-advantages');
        if(empty($imagePath)) {
            $this->addError('icon', 'Не удалось сохранить изображение');
            return false;
        }

        MagicImage::deleteImage($entity->getIconPath());
        $entity->setIconPath($imagePath);

        return true;
    }

    /**
     * @inheritdoc
     * @return TechAdvantage
     */
    protected function createNewEntity() {
        return new TechAdvantage();
    }

    /**
     * @inheritdoc
     * @return AdvantageI18nForm
     */
    protected function createNewI18nForm() {
        return new AdvantageI18nForm();
    }
}