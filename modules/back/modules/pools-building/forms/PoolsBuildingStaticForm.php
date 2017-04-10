<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\PoolsBuildingStatic;
use app\models\PoolsBuildingStaticGallery;
use back\forms\EntityForm;
use back\helpers\MagicImage;
use back\validators\FormImageValidator;

abstract class PoolsBuildingStaticForm extends EntityForm {

    /** @var PoolsBuildingStaticGalleryForm[]  */
    protected $galleryForms = [];

    /** @var PoolsBuildingStatic|null */
    protected $poolsBuildingStatic = null;

    public $bg = null;

    /** @var PoolsBuildingStaticGallery[] */
    protected $galleriesToDelete = [];

    public function rules() {
        $rules = [];
        if($this->hasBgImage()) {
            $rules[] = [
                'bg', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                    return !empty($this->poolsBuildingStatic) ? $this->poolsBuildingStatic->getBgPath() : null;
                }];
        }
        return $rules;
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingStatic $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->poolsBuildingStatic = $entity;
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
     * @param PoolsBuildingStatic $entity
     */
    protected function fillEntity(Entity $entity) {

        $imagesDir = '/images/pools-building-static';

        $imageResult = $this->saveImage('bg', $imagesDir, $entity->getBgPath(), function($path) use($entity) {
            $entity->setBgPath($path);
        }, $entity::BG_WIDTH, $entity::BG_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        $imageResult = $this->saveImage('bg', $imagesDir, $entity->getSmallBgPath(), function($path) use($entity) {
            $entity->setSmallBgPath($path);
        }, $entity::SMALL_BG_WIDTH, $entity::SMALL_BG_HEIGHT);
        if(!$imageResult) {
            return false;
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
                $gallery->setPoolsBuildingStatic($entity);
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
     * @param PoolsBuildingStatic $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'bgUrl' => $entity->getSmallBgPath(),
        ];
    }

    /** @return PoolsBuildingStaticGalleryForm */
    protected abstract function createGalleryForm();

    /**
     * @inheritdoc
     * @return PoolsBuildingStatic
     */
    protected function createNewEntity() {
        return new PoolsBuildingStatic();
    }

    protected abstract function hasBgImage();

}