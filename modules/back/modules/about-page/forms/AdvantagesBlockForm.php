<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\AboutPage;
use back\forms\EntityForm;

class AdvantagesBlockForm extends EntityForm {

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
     * @return HistoryI18nForm
     */
    protected function createNewI18nForm() {
        return new AdvantagesBlockI18nForm();
    }
}