<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\FaqItem;
use back\forms\EntityForm;

class FaqItemForm extends EntityForm {

    /**
     * @inheritdoc
     * @param FaqItem $entity
     */
    protected function populateFromEntity(Entity $entity) {
    }

    /**
     * @inheritdoc
     * @param FaqItem $entity
     */
    protected function fillEntity(Entity $entity) {
        return true;
    }

    /**
     * @inheritdoc
     * @return FaqItem
     */
    protected function createNewEntity() {
        return new FaqItem();
    }

    /**
     * @inheritdoc
     * @return FaqItemI18nForm
     */
    protected function createNewI18nForm() {
        return new FaqItemI18nForm();
    }
}