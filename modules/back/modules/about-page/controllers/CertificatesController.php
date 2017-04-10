<?php

namespace back\AboutPage\controllers;

use app\models\Entity;
use app\models\Certificate;
use back\AboutPage\forms\CertificateForm;
use back\helpers\MagicImage;

class CertificatesController extends CrudController {

    /**
     * @return Response
     */
    protected function actionIndexGET() {
        $id = $this->getEntityId();
        if(!empty($id)) {
            /** @var Entity|null $entity */
            $entity = $this->getEntityRepository()->find($id);
            if(empty($entity)) {
                return $this->getResponse('Сущность не найдена', Response::FORMAT_RAW, 404);
            }
            $form = $this->createEntityForm();
            $form->setEntity($entity);
            return $this->getResponse($form->getData());

        } else {
            $data = [];
            /** @var Entity[] $entities */
            $entities = $this->getEntityRepository()->findBy([],['sort' => 'ASC']);
            foreach($entities as $entity) {
                $data[] = $this->getEntityDataForGrid($entity);
            }
            return $this->getResponse($data);
        }
    }

    /** @inheritdoc */
    protected function createEntityForm() {
        return new CertificateForm();
    }

    /** @inheritdoc */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:Certificate');
    }

    /**
     * @inheritdoc
     * @param Certificate $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'imageUrl' => $entity->getPreviewUrl(),
            'sort' => $entity->getSort()
        ];
    }

    /**
     * @inheritdoc
     * @param Certificate $entity Сущность
     */
    protected function deleteEntityAssets(Entity $entity) {
        MagicImage::deleteImage($entity->getPreviewPath());
        MagicImage::deleteImage($entity->getImagePath());
    }

    public function actionSort(){
        $data = [];
        if(\Yii::$app->getRequest()->getIsPost()) {
            $postData = $this->getRequestBodyJSON();
            $items = $postData['items'];
            $db = \Yii::$app->getDb();
            foreach($items as $item) {
                $cmd = $db->createCommand("UPDATE `Certificate` SET `sort` = ".$item['sort']." WHERE id = ".$item['id']);
                $cmd->execute();
            }
            $data['success'] = 1;
        }
        return $this->getResponse($data);
    }

}