<?php

namespace back\PoolsBuilding\forms;

use app\components\Doctrine;
use app\models\PoolsBuildingStaticGallery;
use app\models\PoolsBuildingStaticGalleryImage;
use Doctrine\ORM\EntityManager;
use yii\base\Model;

abstract class PoolsBuildingStaticGalleryForm extends Model {

    /** @var PoolsBuildingStaticGalleryImageForm[] */
    protected $imageForms = [];

    /** @var PoolsBuildingStaticGalleryImage[] */
    private $imagesToDelete = [];

    public $id = null;

    public function setEntity(PoolsBuildingStaticGallery $gallery) {
        $this->id = $gallery->getId();
        foreach($gallery->getImages() as $image) {
            $this->imagesToDelete[$image->getId()] = $image;
            $imageForm = $this->createImageForm();
            $imageForm->setEntity($image);
            $this->imageForms[] = $imageForm;
        }
    }

    public function getData() {
        $imagesData = [];
        foreach($this->imageForms as $imageForm) {
            $imagesData[] = $imageForm->getData();
        }
        return [
            'id' => $this->id,
            'images' => $imagesData,
        ];
    }

    /**
     * @inheritdoc
     */
    public function load($data, $formName = '') {
        if(!parent::load($data, $formName)) {
            return false;
        }
        if(empty($data['images']) || !is_array($data['images'])) {
            return false;
        }
        foreach($data['images'] as $imageData) {
            $imageForm = null;
            if(!empty($imageData['id'])) {
                foreach($this->imageForms as $i => $form) {
                    if($form->id == $imageData['id']) {
                        $imageForm = $form;
                        unset($this->imagesToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($imageForm)) {
                $imageForm = $this->createImageForm();
                $this->imageForms[] = $imageForm;
            }
            $imageForm->load($imageData, '');
        }
        return true;
    }

    public function fillEntity(PoolsBuildingStaticGallery $gallery) {
        foreach($this->imageForms as $imageForm) {
            $image = null;
            if(!empty($imageForm->id)) {
                foreach($gallery->getImages() as $galleryImage) {
                    if($galleryImage->getId() == $imageForm->id) {
                        $image = $galleryImage;
                        break;
                    }
                }
            }
            if(empty($image)) {
                $image = $imageForm->createNewImage();
                $image->setGallery($gallery);
            }
            if($imageForm->fillEntity($image)) {
                $this->getEntityManager()->persist($image);
            }
        }

        foreach($this->imagesToDelete as $image) {
            $this->getEntityManager()->remove($image);
        }

        return true;
    }

    /** @return EntityManager */
    protected function getEntityManager() {
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        return $doctrine->getEntityManager();
    }

    /** @return PoolsBuildingStaticGallery */
    public abstract function createNewGallery();

    /** @return PoolsBuildingStaticGalleryImageForm */
    protected abstract function createImageForm();

}