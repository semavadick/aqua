<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\Advantage;
use back\forms\EntityForm;
use back\helpers\MagicImage;

class AdvantageForm extends EntityForm {

    public $icon;

    private $advantage = null;

    public function rules() {
        return [
            ['icon', 'checkImage', 'skipOnEmpty' => false],
        ];
    }

    public function checkImage($attribute, $params) {
        if(empty($this->icon) && empty($this->advantage)) {
            $this->addError($attribute, 'Выберите изображение');
        }
    }

    /**
     * @inheritdoc
     * @param Advantage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->advantage = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param Advantage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'iconUrl' => $entity->getIconUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param Advantage $entity
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
        $imagePath = $image->saveToDir('/images/advantages');
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
     * @return Advantage
     */
    protected function createNewEntity() {
        return new Advantage();
    }

    /**
     * @inheritdoc
     * @return AdvantageI18nForm
     */
    protected function createNewI18nForm() {
        return new AdvantageI18nForm();
    }
}