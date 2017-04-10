<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\AboutPage;
use back\forms\EntityForm;
use back\helpers\MagicImage;

class CompetenceForm extends EntityForm {

    public $image;

    public function rules() {
        return [
            ['image', 'checkImage', 'skipOnEmpty' => false],
        ];
    }

    /** @var AboutPage|null */
    private $entityInstance = null;

    public function checkImage($attribute, $params) {
        $currentImageUrl = !empty($this->entityInstance) ? $this->entityInstance->getCompetenceImageUrl() : null;
        if(empty($this->image) && empty($currentImageUrl)) {
            $this->addError($attribute, 'Выберите изображение');
        }
    }

    /**
     * @inheritdoc
     * @param AboutPage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->entityInstance = $entity;
    }

    /**
     * @inheritdoc
     * @param AboutPage $entity
     */
    protected function fillEntity(Entity $entity) {
        if(empty($this->image)) {
            return true;
        }
        $image = MagicImage::createFromDataUrl($this->image);
        if(empty($image)) {
            $this->addError('image', 'Не удалось загрузить изображение');
            return false;
        }
        $imagePath = $image->saveToDir('/images/about');
        if(empty($imagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }
        MagicImage::deleteImage($entity->getCompetenceImagePath());
        $entity->setCompetenceImagePath($imagePath);
        return true;
    }

    /**
     * @inheritdoc
     * @return AboutPage
     */
    protected function createNewEntity() {
        return new AboutPage();
    }

    /**
     * @inheritdoc
     * @return CompetenceI18nForm
     */
    protected function createNewI18nForm() {
        return new CompetenceI18nForm();
    }

    /**
     * @inheritdoc
     * @param AboutPage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'imageUrl' => $entity->getCompetenceImageUrl(),
        ];
    }

}