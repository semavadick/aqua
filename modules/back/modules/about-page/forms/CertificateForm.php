<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\Certificate;
use back\forms\EntityForm;
use back\helpers\MagicImage;

class CertificateForm extends EntityForm {

    public $image;
    public $sort;

    private $entity = null;

    public function rules() {
        return [
            ['image', 'checkImage', 'skipOnEmpty' => false],
            ['sort', 'safe']
        ];
    }

    public function checkImage($attribute, $params) {
        if(empty($this->image) && empty($this->entity)) {
            $this->addError($attribute, 'Выберите изображение');
        }
    }

    /**
     * @inheritdoc
     * @param Certificate $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->entity = $entity;
        $this->sort = $entity->getSort();
        return true;
    }

    /**
     * @inheritdoc
     * @param Certificate $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'imageUrl' => $entity->getPreviewUrl(),
            'sort'     => $entity->getSort()
        ];
    }

    /**
     * @inheritdoc
     * @param Certificate $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setSort($this->sort);
        if(empty($this->image)) {
            return true;
        }

        $image = MagicImage::createFromDataUrl($this->image);
        if(empty($image)) {
            $this->addError('image', 'Не удалось загрузить изображение');
            return false;
        }
        $image->resize($entity::IMAGE_WIDTH, $entity::IMAGE_HEIGHT);
        $imagePath = $image->saveToDir('/images/certificates');
        if(empty($imagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }
        $image->resize($entity::PREVIEW_WIDTH, $entity::PREVIEW_HEIGHT);
        $previewPath = $image->saveToDir('/images/certificates');
        if(empty($previewPath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }

        MagicImage::deleteImage($entity->getPreviewPath());
        MagicImage::deleteImage($entity->getImagePath());
        $entity->setPreviewPath($previewPath);
        $entity->setImagePath($imagePath);

        return true;
    }

    /**
     * @inheritdoc
     * @return Certificate
     */
    protected function createNewEntity() {
        return new Certificate();
    }

    /**
     * @inheritdoc
     * @return CertificateI18nForm
     */
    protected function createNewI18nForm() {
        return new CertificateI18nForm();
    }
}