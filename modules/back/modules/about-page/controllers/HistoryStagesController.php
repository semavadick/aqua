<?php

namespace back\AboutPage\controllers;

use app\models\Entity;
use app\models\HistoryStage;
use back\AboutPage\forms\HistoryStageForm;
use back\helpers\MagicImage;
use yii\helpers\Html;

class HistoryStagesController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new HistoryStageForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:HistoryStage');
    }

    /**
     * @inheritdoc
     * @param HistoryStage $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getImageUrl(),
            'content' => '<h6 class="text-semibold no-margin-top">' . Html::encode($entity->getYear()) . '</h6>' . $entity->getText(),
        ];
    }

    /**
     * @inheritdoc
     * @param HistoryStage $entity Сущность
     */
    protected function deleteEntityAssets(Entity $entity) {
        MagicImage::deleteImage($entity->getImagePath());
    }

}