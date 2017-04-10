<?php

namespace back\MainPage\forms;

use app\models\Entity;
use app\models\MainPage;
use back\forms\EntityForm;

class SeoForm extends EntityForm {

    /**
     * @inheritdoc
     * @param MainPage $entity
     */
    protected function populateFromEntity(Entity $entity) {

    }

    /**
     * @inheritdoc
     * @param MainPage $entity
     */
    protected function fillEntity(Entity $entity) {
        return true;
    }

    /**
     * @inheritdoc
     * @return MainPage
     */
    protected function createNewEntity() {
        return new MainPage();
    }

    /**
     * @inheritdoc
     * @return SeoI18nForm
     */
    protected function createNewI18nForm() {
        return new SeoI18nForm();
    }
}