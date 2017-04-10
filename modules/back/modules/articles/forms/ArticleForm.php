<?php

namespace back\Articles\forms;

use app\models\Article;
use app\models\Category;
use app\models\Entity;
use back\Publications\forms\PublicationForm;

class ArticleForm extends PublicationForm {

    public $categoriesIds = [];

    public function rules() {
        return array_merge(parent::rules(), [
            ['categoriesIds', 'safe']
        ]);
    }

    /** @inheritdoc */
    protected function createNewEntity() {
        return new Article();
    }

    /** @inheritdoc */
    protected function createNewI18nForm() {
        return new ArticleI18nForm();
    }

    /** @inheritdoc */
    protected function createGalleryForm() {
        return new ArticleGalleryForm();
    }

    /**
     * @inheritdoc
     * @param Article $entity
     */
    protected function populateFromEntity(Entity $entity) {
        parent::populateFromEntity($entity);
        foreach($entity->getCategories() as $category) {
            $this->categoriesIds[] = $category->getId();
        }
    }

    /**
     * @inheritdoc
     * @param Article $entity
     */
    protected function fillEntity(Entity $entity) {
        if(!parent::fillEntity($entity)) {
            return false;
        }
        /** @var Category[] $relatedCategories */
        $categories = $this->getEntityManager()->getRepository('Models:Category')->findBy([
            'id' => $this->categoriesIds,
        ]);
        $entity->setCategories($categories);
        return true;
    }

}