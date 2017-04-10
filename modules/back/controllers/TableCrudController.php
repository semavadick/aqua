<?php

namespace back\controllers;

use app\models\Entity;
use back\forms\EntityForm;
use back\forms\SearchForm;
use Doctrine\ORM\EntityRepository;
use yii\web\Response;

/**
 * Базовый класс для CRUD-контроллеров
 */
abstract class TableCrudController extends CrudController {

    /**
     * @return Response
     */
    protected function actionIndexGET() {
        $id = $this->getEntityId();
        if(!empty($id)) {
            return parent::actionIndexGET();

        }
        $form = $this->createSearchForm();
        $req = \Yii::$app->getRequest();
        $form->offset = $req->get('offset');
        $form->limit = $req->get('limit');
        $form->sortAttribute = $req->get('sortAttribute');
        $form->sortDirection = $req->get('sortDirection');
        $searchAttrs = \Yii::$app->getRequest()->get('searchAttributes');
        if(!empty($searchAttrs))  {
            $searchAttrs = json_decode($searchAttrs, true);
            $form->setAttributes($searchAttrs);
        }
        $entitiesData = [];
        foreach($form->findEntities() as $entity) {
            $entitiesData[] = $this->getEntityDataForGrid($entity);
        }
        $data = [
            'entities' => $entitiesData,
            'total' => $form->getTotalEntitiesCount(),
        ];
        return $this->getResponse($data);
    }

    /** @return SearchForm */
    protected abstract function createSearchForm();

}