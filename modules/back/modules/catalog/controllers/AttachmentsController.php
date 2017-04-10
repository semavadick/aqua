<?php

namespace back\Catalog\controllers;

use app\models\Entity;
use app\models\Attachment;
use back\Catalog\forms\AttachmentForm;
use back\controllers\CrudController;
use yii\helpers\Html;

class AttachmentsController extends CrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new AttachmentForm();
    }

    /**
     * @inheritdoc
     */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:Attachment');
    }

    /**
     * @inheritdoc
     * @param Attachment $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getIconPath(),
            'content' => '<h6>' . Html::encode($entity->getText()) . '</h6>',
        ];
    }

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageCatalog();
    }

}