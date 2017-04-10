<?php

namespace back\controllers;

use app\models\Entity;
use back\forms\EntityForm;
use Doctrine\ORM\EntityRepository;
use yii\web\Response;

/**
 * Базовый класс для CRUD-контроллеров
 */
abstract class CrudController extends ModuleController {

    public function actionIndex() {
        switch($this->getRequestMethod()) {
            case 'GET':
            default:
                return $this->actionIndexGET();
                break;

            case 'POST':
                return $this->actionIndexPOST();
                break;

            case 'PUT':
                return $this->actionIndexPUT();
                break;

            case 'DELETE':
                return $this->actionIndexDELETE();
                break;
        }
    }

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
            $entities = $this->getEntityRepository()->findAll();
            foreach($entities as $entity) {
                $data[] = $this->getEntityDataForGrid($entity);
            }
            return $this->getResponse($data);
        }
    }

    /**
     * @return Response
     */
    private function actionIndexPOST() {
        $form = $this->createEntityForm();
        $form->load($this->getRequestBodyJSON());
        if($form->save()) {
            return $this->getResponse('ok', Response::FORMAT_RAW);
        }
        return $this->getResponse($form->getErrors(), Response::FORMAT_JSON, 400);
    }

    /**
     * @return Response
     */
    private function actionIndexPUT() {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '1G');
        $id = $this->getEntityId();
        /** @var Entity|null $entity */
        $entity = $this->getEntityRepository()->find($id);
        if(empty($entity)) {
            return $this->getResponse('Сущность не найдена', Response::FORMAT_RAW, 404);
        }
        $form = $this->createEntityForm();
        $form->setEntity($entity);
        $form->load($this->getRequestBodyJSON());
        if($form->save()) {
            return $this->getResponse('ok', Response::FORMAT_RAW);
        }
        return $this->getResponse($form->getErrors(), Response::FORMAT_JSON, 400);
    }

    /**
     * @return Response
     */
    private function actionIndexDELETE() {
        $id = $this->getEntityId();
        /** @var Entity|null $entity */
        $entity = $this->getEntityRepository()->find($id);
        if(empty($entity)) {
            return $this->getResponse('Сущность не найдена', Response::FORMAT_RAW, 404);
        }
        $this->deleteEntityAssets($entity);
        $em = $this->getEntityManager();
        $em->remove($entity);
        $em->flush();
        return $this->getResponse('ok', Response::FORMAT_RAW);
    }

    /** @return int|null */
    protected function getEntityId() {
        return \Yii::$app->getRequest()->get('id');
    }

    /** @return EntityForm */
    protected abstract function createEntityForm();

    /** @return EntityRepository */
    protected abstract function getEntityRepository();

    /**
     * @param Entity $entity
     * @return array
     */
    protected abstract function getEntityDataForGrid(Entity $entity);

    /**
     * Удаляет асстеты сущности
     * @param Entity $entity Сущность
     */
    protected function deleteEntityAssets(Entity $entity) { }

}