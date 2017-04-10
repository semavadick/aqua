<?php

namespace back\MainPage\forms;

use app\models\Entity;
use app\models\MainPageBanner;
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
     * @param MainPageBanner $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->banner = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param MainPageBanner $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param MainPageBanner $entity
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
        $imagePath = $image->saveToDir('/images/banners');
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
     * @return MainPageBanner
     */
    protected function createNewEntity() {
        return new MainPageBanner();
    }

    /**
     * @inheritdoc
     * @return BannerI18nForm
     */
    protected function createNewI18nForm() {
        return new BannerI18nForm();
    }
}