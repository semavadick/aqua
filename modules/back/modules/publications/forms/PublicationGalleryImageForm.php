<?php

namespace back\Publications\forms;

use app\models\Entity;
use app\models\PublicationGalleryImage;
use back\forms\EntityForm;
use back\helpers\MagicImage;

abstract class PublicationGalleryImageForm extends EntityForm {

    public $id = null;
    public $image = '';
    public $sort;

    /** @var PublicationGalleryImage|null */
    protected $imageEntity = null;

    public function rules() {
        return [
            [['image'], 'checkImage', 'skipOnEmpty' => false],
            ['sort','safe']
        ];
    }

    public function checkImage($attribute, $params) {
        if(empty($this->$attribute) && empty($this->imageEntity)) {
            $this->addError($attribute, 'Выберите изображение');
        }
    }

    /** @return PublicationGalleryImage */
    public abstract function createNewImage();

    /**
     * @inheritdoc
     * @param PublicationGalleryImage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->imageEntity = $entity;
        $this->id = $entity->getId();
        $this->sort = $entity->getSort();
    }

    /**
     * @inheritdoc
     * @param PublicationGalleryImage $entity
     */
    public function fillEntity(Entity $entity) {
        $entity->setSort($this->sort);
        foreach($this->i18nForms as $i18nForm) {
            $i18n = $entity->getI18n($i18nForm->getLanguage());
            if(empty($i18n)) {
                $i18n = $i18nForm->createNewI18n();
                $i18n->setLanguage($i18nForm->getLanguage());
            }
            $i18nForm->fillI18n($i18n, $entity);
            $this->getEntityManager()->persist($i18n);
        }

        if(empty($this->image)) {
            return true;
        }

        $image = MagicImage::createFromDataUrl($this->image);
        if(empty($image)) {
            $this->addError('image', 'Не удалось загрузить изображение');
            return false;
        }
        $image->resizeToMaxSize($entity::BIG_WIDTH, $entity::BIG_HEIGHT);
        $bigPath = $image->saveToDir('/images/publication-galleries');
        if(empty($bigPath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }
        $image->resizeToMaxSize($entity::MEDIUM_WIDTH, $entity::MEDIUM_HEIGHT);
        $mediumPath = $image->saveToDir('/images/publication-galleries');
        if(empty($mediumPath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }
        $image->resizeToMaxSize($entity::SMALL_WIDTH, $entity::SMALL_HEIGHT);
        $smallPath = $image->saveToDir('/images/publication-galleries');
        if(empty($smallPath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }

        MagicImage::deleteImage($entity->getBigPath());
        MagicImage::deleteImage($entity->getMediumPath());
        MagicImage::deleteImage($entity->getSmallPath());
        $entity->setBigPath($bigPath);
        $entity->setMediumPath($mediumPath);
        $entity->setSmallPath($smallPath);

        return true;
    }

    /**
     * @inheritdoc
     * @param PublicationGalleryImage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'imageUrl' => $entity->getMediumPath(),
        ];
    }

}