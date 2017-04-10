<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\PoolsBuildingPage;
use back\forms\EntityForm;
use back\helpers\MagicImage;
use back\validators\FormImageValidator;

abstract class ServiceForm extends EntityForm {

    public $icon = '';
    public $image = '';

    /** @var PoolsBuildingPage|null */
    protected $page = null;

    public function rules() {
        return [
            [['icon', 'image'], FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                if(empty($this->page)) {
                    return null;
                }
                switch($attribute) {
                    case 'image':
                        return $this->getImagePath($this->page);
                        break;

                    case 'icon':
                        return $this->getIconPath($this->page);
                        break;
                }
                return null;
            }],
        ];
    }

    public abstract function getIconPath(PoolsBuildingPage $page);
    public abstract function setIconPath(PoolsBuildingPage $page, $path);
    public abstract function getImagePath(PoolsBuildingPage $page);
    public abstract function setImagePath(PoolsBuildingPage $page, $path);

    /**
     * @inheritdoc
     * @param PoolsBuildingPage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->page = $entity;
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingPage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'iconUrl' => $this->getIconPath($entity),
            'imageUrl' => $this->getImagePath($entity),
        ];
    }

    /**
     * @inheritdoc
     * @return PoolsBuildingPage
     */
    protected function createNewEntity() {
        return new PoolsBuildingPage();
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingPage $entity
     */
    protected function fillEntity(Entity $entity) {
        if(!empty($this->icon)) {
            $image = MagicImage::createFromDataUrl($this->icon);
            if(empty($image)) {
                $this->addError('icon', 'Не удалось загрузить изображение');
                return false;
            }
            $image->resizeToMaxSize($entity::MAX_ICON_WIDTH, $entity::MAX_ICON_HEIGHT);
            $iconPath = $image->saveToDir('/images/pools-building');
            if(empty($iconPath)) {
                $this->addError('icon', 'Не удалось сохранить изображение');
                return false;
            }
            MagicImage::deleteImage($this->getIconPath($entity));
            $this->setIconPath($entity, $iconPath);
        }

        if(!empty($this->image)) {
            $image = MagicImage::createFromDataUrl($this->image);
            if(empty($image)) {
                $this->addError('image', 'Не удалось загрузить изображение');
                return false;
            }
            $image->resizeToMaxSize($entity::MAX_IMAGE_WIDTH, $entity::MAX_IMAGE_HEIGHT);
            $imagePath = $image->saveToDir('/images/pools-building');
            if(empty($imagePath)) {
                $this->addError('image', 'Не удалось сохранить изображение');
                return false;
            }
            MagicImage::deleteImage($this->getImagePath($entity));
            $this->setImagePath($entity, $imagePath);
        }

        return true;
    }


}