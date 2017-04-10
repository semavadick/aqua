<?php

namespace back\Publications\forms;

use app\models\Entity;
use app\models\Publication;
use app\models\PublicationGallery;
use back\forms\EntityForm;
use back\helpers\MagicImage;

abstract class PublicationForm extends EntityForm {

    /** @var PublicationGalleryForm[]  */
    protected $galleryForms = [];

    /** @var Publication|null */
    protected $publication = null;

    public $preview = null;
    public $bg = null;

    public $added = null;

    public $active = true;

    /** @var PublicationGallery[] */
    protected $galleriesToDelete = [];

    public function rules() {
        return [
            [['preview', 'bg'], 'checkImage', 'skipOnEmpty' => false],
            [['added','active'], 'safe']
        ];
    }

    public function checkImage($attribute, $params) {
        if(empty($this->$attribute) && empty($this->publication)) {
            $this->addError($attribute, 'Выберите изображение');
        }
    }


    /**
     * @inheritdoc
     * @param Publication $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->publication = $entity;
        $this->added = $entity->getAdded();
        $this->active = $entity->getActive();
        foreach($entity->getGalleries() as $gallery) {
            $this->galleriesToDelete[$gallery->getId()] = $gallery;
            $galleryForm = $this->createGalleryForm();
            $galleryForm->setEntity($gallery);
            $this->galleryForms[] = $galleryForm;
        }
    }


    /**
     * @inheritdoc
     */
    public function getData() {
        $data = parent::getData();
        $data['galleries'] = [];
        foreach($this->galleryForms as $galleryForm) {
            $data['galleries'][] = $galleryForm->getData();
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function load($data, $formName = '') {
        if(!parent::load($data, $formName)) {
            return false;
        }
        if(empty($data['galleries']) || !is_array($data['galleries'])) {
            return false;
        }
        foreach($data['galleries'] as $galleryData) {
            $galleryForm = null;
            if(!empty($galleryData['id'])) {
                foreach($this->galleryForms as $form) {
                    if($form->id == $galleryData['id']) {
                        $galleryForm = $form;
                        unset($this->galleriesToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($galleryForm)) {
                $galleryForm = $this->createGalleryForm();
                $this->galleryForms[] = $galleryForm;
            }
            $galleryForm->load($galleryData, '');
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param Publication $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setAdded($this->added);
        $entity->setActive($this->active);
        if(!empty($this->preview)) {
            $image = MagicImage::createFromDataUrl($this->preview);
            if(empty($image)) {
                $this->addError('preview', 'Не удалось загрузить изображение');
                return false;
            }
            $image->resize($entity::PREVIEW_WIDTH, $entity::PREVIEW_HEIGHT);
            $previewPath = $image->saveToDir('/images/publications');
            if(empty($previewPath)) {
                $this->addError('preview', 'Не удалось сохранить изображение');
                return false;
            }
        }
        if(!empty($previewPath)) {
            MagicImage::deleteImage($entity->getPreviewPath());
            $entity->setPreviewPath($previewPath);
        }

        if(!empty($this->bg)) {
            $image = MagicImage::createFromDataUrl($this->bg);
            if(empty($image)) {
                $this->addError('bg', 'Не удалось загрузить изображение');
                return false;
            }
            $image->resize($entity::BG_WIDTH, $entity::BG_HEIGHT);
            $bgPath = $image->saveToDir('/images/publications');
            if(empty($bgPath)) {
                $this->addError('bg', 'Не удалось сохранить изображение');
                return false;
            }
            $image->resize($entity::SMALL_BG_WIDTH, $entity::SMALL_BG_HEIGHT);
            $smallBgPath = $image->saveToDir('/images/publications');
            if(empty($smallBgPath)) {
                $this->addError('bg', 'Не удалось сохранить изображение');
                return false;
            }
        }
        if(!empty($bgPath)) {
            MagicImage::deleteImage($entity->getBgPath());
            $entity->setBgPath($bgPath);
        }
        if(!empty($smallBgPath)) {
            MagicImage::deleteImage($entity->getSmallBgPath());
            $entity->setSmallBgPath($smallBgPath);
        }

        foreach($this->galleryForms as $galleryForm) {
            $gallery = null;
            if(!empty($galleryForm->id)) {
                foreach($entity->getGalleries() as $publGallery) {
                    if($publGallery->getId() == $galleryForm->id) {
                        $gallery = $publGallery;
                        break;
                    }
                }
            }
            if(empty($gallery)) {
                $gallery = $galleryForm->createNewGallery();
                $gallery->setPublication($entity);
            }
            $this->getEntityManager()->persist($gallery);
            $galleryForm->fillEntity($gallery);
        }

        foreach($this->galleriesToDelete as $gallery) {
            $this->getEntityManager()->remove($gallery);
        }

        return true;
    }

    /**
     * @inheritdoc
     * @param Publication $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'previewUrl' => $entity->getPreviewPath(),
            'bgUrl' => $entity->getSmallBgPath(),
        ];
    }

    /** @return PublicationGalleryForm */
    protected abstract function createGalleryForm();

}