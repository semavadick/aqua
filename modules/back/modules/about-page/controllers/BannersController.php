<?php

namespace back\AboutPage\controllers;

use app\models\Entity;
use app\models\ProductionBanner;
use back\helpers\MagicImage;
use back\AboutPage\forms\BannerForm;

class BannersController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new BannerForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:ProductionBanner');
    }

    /**
     * @inheritdoc
     * @param ProductionBanner $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param ProductionBanner $entity Сущность
     */
    protected function deleteEntityAssets(Entity $entity) {
        MagicImage::deleteImage($entity->getImagePath());
    }

}