<?php

namespace back\PoolsBuilding\controllers;

use app\models\Entity;
use app\models\PoolType;
use back\PoolsBuilding\forms\PoolTypeForm;
use back\helpers\MagicImage;
use yii\helpers\Html;

class PoolTypesController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new PoolTypeForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:PoolType');
    }

    /**
     * @inheritdoc
     * @param PoolType $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getPreviewUrlForGrid(),
            'content' => '<h6>' . Html::encode($entity->getName()) . '</h6>',
        ];
    }

}