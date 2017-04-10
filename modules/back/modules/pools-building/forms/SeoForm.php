<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\PoolsBuildingPage;
use back\forms\EntityForm;

class SeoForm extends EntityForm {

    /**
     * @inheritdoc
     * @param PoolsBuildingPage $entity
     */
    protected function populateFromEntity(Entity $entity) {

    }

    /**
     * @inheritdoc
     * @param PoolsBuildingPage $entity
     */
    protected function fillEntity(Entity $entity) {
        return true;
    }

    /**
     * @inheritdoc
     * @return PoolsBuildingPage
     */
    protected function createNewEntity() {
        return new PoolsBuildingPage();
    }

    /**
     * @inheritdoc
     * @return SeoI18nForm
     */
    protected function createNewI18nForm() {
        return new SeoI18nForm();
    }
}