<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\ProductionImage;
use back\forms\EntityForm;
use back\helpers\MagicImage;

class ProductionImageForm extends EntityForm {

    public $image;

    private $banner = null;

    public function rules() {
        return [
            ['image', 'checkImage', 'skipOnEmpty' => false],
        ];
    }

    public function checkImage($attribute, $params) {
        if(empty($this->image) && empty($this->banner)) {
            $this->addError('image', 'Выберите изображение');
        }
    }

    /**
     * @inheritdoc
     * @param ProductionImage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->banner = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param ProductionImage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param ProductionImage $entity
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
        $image->resize($entity::IMAGE_WIDTH, $entity::IMAGE_HEIGHT);
        $imagePath = $image->saveToDir('/images/production');
        if(empty($imagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }
        $image->resize($entity::MEDIUM_IMAGE_WIDTH, $entity::MEDIUM_IMAGE_HEIGHT);
        $mediumImagePath = $image->saveToDir('/images/production');
        if(empty($mediumImagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }
        $image->resize($entity::SMALL_IMAGE_WIDTH, $entity::SMALL_IMAGE_HEIGHT);
        $smallImagePath = $image->saveToDir('/images/production');
        if(empty($smallImagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }

        MagicImage::deleteImage($entity->getImagePath());
        MagicImage::deleteImage($entity->getMediumImagePath());
        MagicImage::deleteImage($entity->getSmallImagePath());
        $entity->setImagePath($imagePath);
        $entity->setMediumImagePath($mediumImagePath);
        $entity->setSmallImagePath($smallImagePath);

        $entity->setImagePath($imagePath);

        return true;
    }

    /**
     * @inheritdoc
     * @return ProductionImage
     */
    protected function createNewEntity() {
        return new ProductionImage();
    }

    /**
     * @inheritdoc
     * @return ProductionImageI18nForm
     */
    protected function createNewI18nForm() {
        return new ProductionImageI18nForm();
    }
}