<?php

namespace back\Articles\controllers;

use app\models\Entity;
use app\models\Article;
use back\controllers\TableCrudController;
use back\Articles\forms\ArticleForm;
use back\Articles\forms\SearchForm;

class ArticlesController extends TableCrudController {

    /** @inheritdoc */
    protected function createEntityForm() {
        return new ArticleForm();
    }

    /** @inheritdoc*/
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:Article');
    }

    /**
     * @inheritdoc
     * @param Article $entity
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
        return $this->getWebUser()->canManageArticles();
    }

}