<?php

namespace back\AboutPage\controllers;

use app\models\Entity;
use app\models\Office;
use back\AboutPage\forms\OfficeForm;
use yii\helpers\Html;

class OfficesController extends CrudController {

    public function actionRegions() {
        $data = $this->createEntityForm()->getRegionsData();
        return $this->getResponse($data);
    }

    /** @inheritdoc */
    protected function createEntityForm() {
        return new OfficeForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:Office');
    }

    /**
     * @inheritdoc
     * @param Office $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'content' => '<h6>' . Html::encode($entity->getAddress()) . '</h6>',
        ];
    }

}