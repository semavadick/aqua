<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\OfficeRegion;
use back\forms\EntityForm;
use back\helpers\MagicImage;

class OfficeRegionForm extends EntityForm {

    /**
     * @inheritdoc
     * @param OfficeRegion $entity
     */
    protected function populateFromEntity(Entity $entity) {
        return true;
    }

    /**
     * @inheritdoc
     * @param OfficeRegion $entity
     */
    protected function fillEntity(Entity $entity) {
        return true;
    }

    /**
     * @inheritdoc
     * @return OfficeRegion
     */
    protected function createNewEntity() {
        return new OfficeRegion();
    }

    /**
     * @inheritdoc
     * @return OfficeRegionI18nForm
     */
    protected function createNewI18nForm() {
        return new OfficeRegionI18nForm();
    }
}