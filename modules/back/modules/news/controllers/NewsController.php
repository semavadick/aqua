<?php

namespace back\News\controllers;

use app\models\Entity;
use app\models\News;
use back\controllers\TableCrudController;
use back\helpers\MagicImage;
use back\News\forms\NewsForm;
use back\News\forms\SearchForm;

class NewsController extends TableCrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new NewsForm();
    }

    /** @inheritdoc*/
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:News');
    }

    /**
     * @inheritdoc
     * @param News $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'added' => $entity->getAdded(),
        ];
    }

    /** @inheritdoc */
    protected function createSearchForm() {
        return new SearchForm();
    }

    /** @return boolean */
    protected function checkAccess() {
        return $this->getWebUser()->canManageNews();
    }

}