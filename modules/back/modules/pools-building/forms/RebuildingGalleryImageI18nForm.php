<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingStaticGalleryImageI18n;

class RebuildingGalleryImageI18nForm extends PoolsBuildingStaticGalleryImageI18nForm {

    /** @inheritdoc */
    public function createNewI18n() {
        return new PoolsBuildingStaticGalleryImageI18n();
    }

}