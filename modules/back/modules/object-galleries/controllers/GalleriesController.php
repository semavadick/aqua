<?php

namespace back\ObjectGalleries\controllers;

use app\models\Entity;
use app\models\ObjectGallery;
use back\controllers\TableCrudController;
use back\ObjectGalleries\forms\GalleryForm;
use back\ObjectGalleries\forms\SearchForm;

class GalleriesController extends TableCrudController {

    public function actionPoolTypes() {
        return $this->getResponse($this->createEntityForm()->getPoolTypes());
    }

    /** @inheritdoc */
    protected function createEntityForm() {
        return new GalleryForm();
    }

    /** @inheritdoc*/
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:ObjectGallery');
    }

    /**
     * @inheritdoc
     * @param ObjectGallery $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'imagesCount' => $entity->getImagesCount(),
        ];
    }

    /** @inheritdoc */
    protected function createSearchForm() {
        return new SearchForm();
    }

    /** @return boolean */
    protected function checkAccess() {
        return $this->getWebUser()->canManageObjectGalleries();
    }

}