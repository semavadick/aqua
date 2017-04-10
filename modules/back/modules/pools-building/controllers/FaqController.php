<?php

namespace back\PoolsBuilding\controllers;

use app\models\Entity;
use app\models\FaqItem;
use back\PoolsBuilding\forms\FaqItemForm;

class FaqController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new FaqItemForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:FaqItem');
    }

    /**
     * @inheritdoc
     * @param FaqItem $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'question' => $entity->getQuestion(),
            'answer' => $entity->getAnswer(),
        ];
    }

}