<?php

namespace back\PoolsBuilding\controllers;

use app\models\Entity;
use app\models\TechAdvantage;
use back\PoolsBuilding\forms\AdvantageForm;
use back\helpers\MagicImage;
use yii\helpers\Html;

class AdvantagesController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new AdvantageForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:TechAdvantage');
    }

    /**
     * @inheritdoc
     * @param TechAdvantage $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getIconUrl(),
            'content' => '<h6>' . Html::encode($entity->getTagline()) . '</h6>',
        ];
    }

}