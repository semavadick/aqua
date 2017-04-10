<?php

namespace back\MainPage\controllers;

use app\models\Entity;
use app\models\MainPageBanner;
use back\helpers\MagicImage;
use back\MainPage\forms\BannerForm;

class BannersController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new BannerForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:MainPageBanner');
    }

    /**
     * @inheritdoc
     * @param MainPageBanner $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param MainPageBanner $entity Сущность
     */
    protected function deleteEntityAssets(Entity $entity) {
        MagicImage::deleteImage($entity->getImagePath());
    }

}