<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingStaticGallery;

class RebuildingGalleryForm extends PoolsBuildingStaticGalleryForm {

    /** @inheritdoc */
    public function createNewGallery() {
        return new PoolsBuildingStaticGallery();
    }

    /** @inheritdoc */
    protected function createImageForm() {
        return new RebuildingGalleryImageForm();
    }
}