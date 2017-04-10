<?php

namespace back\MainPage\controllers;

use app\models\Entity;
use app\models\MainPageSlide;
use back\helpers\MagicImage;
use back\MainPage\forms\SlideForm;

class SlidesController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new SlideForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:MainPageSlide');
    }

    /**
     * @inheritdoc
     * @param MainPageSlide $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param MainPageSlide $entity Сущность
     */
    protected function deleteEntityAssets(Entity $entity) {
        MagicImage::deleteImage($entity->getImagePath());
        MagicImage::deleteImage($entity->getSmallImagePath());
    }

}