<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\ProductionBanner;
use back\forms\EntityForm;
use back\helpers\MagicImage;

class BannerForm extends EntityForm {

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
     * @param ProductionBanner $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->banner = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param ProductionBanner $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param ProductionBanner $entity
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
        $imagePath = $image->saveToDir('/images/production');
        if(empty($imagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }

        MagicImage::deleteImage($entity->getImagePath());

        $entity->setImagePath($imagePath);

        return true;
    }

    /**
     * @inheritdoc
     * @return ProductionBanner
     */
    protected function createNewEntity() {
        return new ProductionBanner();
    }

    /**
     * @inheritdoc
     * @return BannerI18nForm
     */
    protected function createNewI18nForm() {
        return new BannerI18nForm();
    }
}