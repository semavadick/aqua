<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\AboutPage;
use back\forms\EntityForm;

class ProductionForm extends EntityForm {

    /**
     * @inheritdoc
     * @param AboutPage $entity
     */
    protected function populateFromEntity(Entity $entity) {

    }

    /**
     * @inheritdoc
     * @param AboutPage $entity
     */
    protected function fillEntity(Entity $entity) {
        return true;
    }

    /**
     * @inheritdoc
     * @return AboutPage
     */
    protected function createNewEntity() {
        return new AboutPage();
    }

    /**
     * @inheritdoc
     * @return CompetenceI18nForm
     */
    protected function createNewI18nForm() {
        return new ProductionI18nForm();
    }

    /**
     * @inheritdoc
     * @param AboutPage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [

        ];
    }

}