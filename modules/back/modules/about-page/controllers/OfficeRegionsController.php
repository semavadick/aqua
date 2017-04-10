<?php

namespace back\AboutPage\controllers;

use app\models\Entity;
use app\models\OfficeRegion;
use back\AboutPage\forms\OfficeRegionForm;
use yii\helpers\Html;

class OfficeRegionsController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new OfficeRegionForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:OfficeRegion');
    }

    /**
     * @inheritdoc
     * @param OfficeRegion $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'content' => '<h5>' . Html::encode($entity->getName()) . '</h5>',
        ];
    }

}