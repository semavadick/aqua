<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\AboutPage;
use back\forms\EntityForm;

class SeoForm extends EntityForm {

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
     * @return SeoI18nForm
     */
    protected function createNewI18nForm() {
        return new SeoI18nForm();
    }
}