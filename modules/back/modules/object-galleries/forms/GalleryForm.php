<?php

namespace back\ObjectGalleries\forms;

use app\models\Entity;
use app\models\ObjectGallery;
use app\models\ObjectGalleryImage;
use app\models\PoolType;
use back\forms\EntityForm;

class GalleryForm extends EntityForm {

    public $isTop = false;
    public $isExclusive = false;
    public $coordsLat = 0;
    public $coordsLng = 0;
    public $typeIds = [];

    /** @var GalleryImageForm[] */
    private $imageForms = [];

    /** @var ObjectGalleryImage[] */
    private $imagesToDelete = [];

    public function rules() {
        $rules = [
            [['coordsLat', 'coordsLng'], 'required', 'message' => 'Заполните поле'],
            ['coordsLat', 'number', 'min' => -90, 'max' => 90],
            ['coordsLng', 'number', 'min' => -180, 'max' => 180],
            [['isTop', 'isExclusive'], 'boolean'],
            ['typeIds', 'safe'],
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function attributeLabels() {
        return [
            'coordsLat' => 'Широта',
            'coordsLng' => 'Долгота',
        ];
    }

    public function getPoolTypes() {
        $data = [];
        /** @var PoolType[] $types */
        $types = $this->getEntityManager()->getRepository('Models:PoolType')->findAll();
        foreach($types as $type) {
            $data[] = [
                'id' => $type->getId(),
                'name' => $type->getName(),
            ];
        }
        return $data;
    }

    /**
     * @inheritdoc
     * @param ObjectGallery $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->isTop = $entity->getIsTop();
        $this->isExclusive = $entity->getIsExclusive();
        $this->coordsLat = $entity->getCoordsLat();
        $this->coordsLng = $entity->getCoordsLng();
        foreach($entity->getImages() as $image) {
            $this->imagesToDelete[$image->getId()] = $image;
            $form = new GalleryImageForm();
            $form->setEntity($image);
            $this->imageForms[] = $form;
        }
        foreach($entity->getPoolTypes() as $type) {
            $this->typeIds[] = $type->getId();
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param ObjectGallery $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        $data = [
            'images' => [

            ],
        ];
        $i = 1;
        foreach($this->imageForms as $form) {
            $image = $form->getData();
            $image['sort'] = $i;
            $data['images'][] = $image;
            $i++;
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
        if(empty($data['images']) || !is_array($data['images'])) {
            return false;
        }
        foreach($data['images'] as $imageData) {
            $imageForm = null;
            if(!empty($imageData['id'])) {
                foreach($this->imageForms as $form) {
                    if($form->id == $imageData['id']) {
                        $imageForm = $form;
                        unset($this->imagesToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($imageForm)) {
                $imageForm = new GalleryImageForm();
                $this->imageForms[] = $imageForm;
            }
            $imageForm->load($imageData, '');
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param ObjectGallery $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setIsTop($this->isTop);
        $entity->setIsExclusive($this->isExclusive);
        $entity->setCoordsLat($this->coordsLat);
        $entity->setCoordsLng($this->coordsLng);

        $rep = $this->getEntityManager()->getRepository('Models:PoolType');
        $types = [];
        foreach($this->typeIds as $typeId) {
            $type = $rep->find($typeId);
            if(empty($typeId)) {
                continue;
            }
            $types[] = $type;
        }
        $entity->setPoolTypes($types);

        foreach($this->imageForms as $imageForm) {
            $advantage = null;
            if(!empty($imageForm->id)) {
                foreach($entity->getImages() as $objImage) {
                    if($objImage->getId() == $imageForm->id) {
                        $advantage = $objImage;
                        break;
                    }
                }
            }
            if(empty($advantage)) {
                $advantage = new ObjectGalleryImage();
                $advantage->setGallery($entity);
            }
            $this->getEntityManager()->persist($advantage);
            $imageForm->fillEntity($advantage);
        }

        foreach($this->imagesToDelete as $advantage) {
            $this->getEntityManager()->remove($advantage);
        }

        return true;
    }

    /**
     * @inheritdoc
     * @return ObjectGallery
     */
    protected function createNewEntity() {
        return new ObjectGallery();
    }

    /**
     * @inheritdoc
     * @return ObjectGalleryI18nForm
     */
    protected function createNewI18nForm() {
        return new ObjectGalleryI18nForm();
    }

}