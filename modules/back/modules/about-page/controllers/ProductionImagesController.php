<?php

namespace back\AboutPage\controllers;

use app\models\Entity;
use app\models\ProductionImage;
use back\helpers\MagicImage;
use back\AboutPage\forms\ProductionImageForm;

class ProductionImagesController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new ProductionImageForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:ProductionImage');
    }

    /**
     * @inheritdoc
     * @param ProductionImage $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getMediumImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param ProductionImage $entity Сущность
     */
    protected function deleteEntityAssets(Entity $entity) {
        MagicImage::deleteImage($entity->getImagePath());
        MagicImage::deleteImage($entity->getMediumImagePath());
        MagicImage::deleteImage($entity->getSmallImagePath());
    }

}