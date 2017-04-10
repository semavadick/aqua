<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingPage;

class BuildingForm extends ServiceForm {

    protected function createNewI18nForm() {
        return new BuildingI18nForm();
    }

    public function getIconPath(PoolsBuildingPage $page) {
        return $page->getBuildingIconPath();
    }

    public function setIconPath(PoolsBuildingPage $page, $path) {
        $page->setBuildingIconPath($path);
    }

    public function getImagePath(PoolsBuildingPage $page) {
        return $page->getBuildingImagePath();
    }

    public function setImagePath(PoolsBuildingPage $page, $path) {
        $page->setBuildingImagePath($path);
    }

}