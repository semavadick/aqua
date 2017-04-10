<?php

namespace back\PoolsBuilding\forms;

class RebuildingForm extends PoolsBuildingStaticForm {

    protected function createNewI18nForm() {
        return new RebuildingI18nForm();
    }

    protected function createGalleryForm() {
        return new RebuildingGalleryForm();
    }

    protected function hasBgImage() {
        return true;
    }
}