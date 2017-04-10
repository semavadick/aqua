<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\models\CatalogPage;
use back\forms\EntityForm;

class GeneralForm extends EntityForm {

    /**
     * @inheritdoc
     * @param CatalogPage $entity
     */
    protected function populateFromEntity(Entity $entity) {

    }

    /**
     * @inheritdoc
     * @param CatalogPage $entity
     */
    protected function fillEntity(Entity $entity) {
        return true;
    }

    /**
     * @inheritdoc
     * @return CatalogPage
     */
    protected function createNewEntity() {
        return new CatalogPage();
    }

    /**
     * @inheritdoc
     * @return GeneralI18nForm
     */
    protected function createNewI18nForm() {
        return new GeneralI18nForm();
    }
}