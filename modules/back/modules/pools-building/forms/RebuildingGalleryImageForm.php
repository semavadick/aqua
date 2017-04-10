<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingStaticGalleryImage;

class RebuildingGalleryImageForm extends PoolsBuildingStaticGalleryImageForm {

    /** @inheritdoc */
    protected function createNewEntity() {
        return $this->createNewImage();
    }

    /** @inheritdoc */
    protected function createNewI18nForm() {
        return new RebuildingGalleryImageI18nForm();
    }

    /** @inheritdoc */
    public function createNewImage() {
        return new PoolsBuildingStaticGalleryImage();
    }
}