<?php

namespace back\ObjectGalleries\forms;

use app\models\Entity;
use app\models\ObjectGalleryImage;
use back\forms\EntityForm;
use back\forms\Form;
use back\validators\FormImageValidator;

class GalleryImageForm extends Form {

    public $id = null;
    public $image;
    public $sort;

    /** @var ObjectGalleryImage|null */
    private $entity = null;

    public function rules() {
        return [
            ['image', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->entity) ? $this->entity->getSmallPath() : null;
            }],
            ['sort', 'safe'],
        ];
    }

    /**
     * @param ObjectGalleryImage $entity
     */
    public function setEntity(ObjectGalleryImage $entity) {
        $this->entity = $entity;
        $this->id = $entity->getId();
        $this->sort = $entity->getSort();
    }

    /**
     * @return array
     */
    public function getData() {
        if(empty($this->entity)) {
            return [
                'id' => null,
                'imageUrl' => null,
            ];
        }
        return [
            'id' => $this->entity->getId(),
            'imageUrl' => $this->entity->getMediumPath(),
        ];
    }

    /**
     * @inheritdoc
     * @param ObjectGalleryImage $entity
     */
    public function fillEntity(Entity $entity) {
        $entity->setSort($this->sort);
        $dir = '/images/object-galleries';

        $imageResult = $this->saveImage('image', $dir, $entity->getSmallPath(), function($path) use($entity) {
            $entity->setSmallPath($path);
        }, null, null, $entity::SMALL_WIDTH, $entity::SMALL_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        $imageResult = $this->saveImage('image', $dir, $entity->getMediumPath(), function($path) use($entity) {
            $entity->setMediumPath($path);
        }, null, null, $entity::MEDIUM_WIDTH, $entity::MEDIUM_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        $imageResult = $this->saveImage('image', $dir, $entity->getBigPath(), function($path) use($entity) {
            $entity->setBigPath($path);
        }, null, null, $entity::BIG_WIDTH, $entity::BIG_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        return true;
    }

}