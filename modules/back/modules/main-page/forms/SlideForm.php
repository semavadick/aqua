<?php

namespace back\MainPage\forms;

use app\models\Entity;
use app\models\MainPageSlide;
use back\forms\EntityForm;
use back\helpers\MagicImage;

class SlideForm extends EntityForm {

    public $image;

    private $slide = null;

    public function rules() {
        return [
            ['image', 'checkImage', 'skipOnEmpty' => false],
        ];
    }

    public function checkImage($attribute, $params) {
        if(empty($this->image) && empty($this->slide)) {
            $this->addError('image', 'Выберите изображение');
        }
    }

    /**
     * @inheritdoc
     * @param MainPageSlide $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->slide = $entity;
        return true;
    }

    /**
     * @inheritdoc
     * @param MainPageSlide $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param MainPageSlide $entity
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
        $imagePath = $image->saveToDir('/images/slides');
        if(empty($imagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }
        $image->resize($entity::SMALLIMAGE_WIDTH, $entity::SMALL_IMAGE_HEIGHT);
        $smallImagePath = $image->saveToDir('/images/slides');
        if(empty($smallImagePath)) {
            $this->addError('image',  'Не удалось сохранить изображение');
            return false;
        }

        MagicImage::deleteImage($entity->getImagePath());
        MagicImage::deleteImage($entity->getSmallImagePath());

        $entity->setImagePath($imagePath);
        $entity->setSmallImagePath($smallImagePath);

        return true;
    }

    /**
     * @inheritdoc
     * @return MainPageSlide
     */
    protected function createNewEntity() {
        return new MainPageSlide();
    }

    /**
     * @inheritdoc
     * @return SlideI18nForm
     */
    protected function createNewI18nForm() {
        return new SlideI18nForm();
    }
}