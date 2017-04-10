<?php

namespace back\AboutPage\controllers;

use app\models\Entity;
use app\models\Advantage;
use back\AboutPage\forms\AdvantageForm;
use back\helpers\MagicImage;

class AdvantagesController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new AdvantageForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:Advantage');
    }

    /**
     * @inheritdoc
     * @param Advantage $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getIconUrl(),
            'content' => $entity->getText(),
        ];
    }

    /**
     * @inheritdoc
     * @param Advantage $entity Сущность
     */
    protected function deleteEntityAssets(Entity $entity) {
        MagicImage::deleteImage($entity->getIconPath());
    }

}