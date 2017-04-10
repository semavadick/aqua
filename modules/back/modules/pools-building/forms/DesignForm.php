<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingPage;

class DesignForm extends ServiceForm {

    protected function createNewI18nForm() {
        return new DesignI18nForm();
    }

    public function getIconPath(PoolsBuildingPage $page) {
        return $page->getDesignIconPath();
    }

    public function setIconPath(PoolsBuildingPage $page, $path) {
        $page->setDesignIconPath($path);
    }

    public function getImagePath(PoolsBuildingPage $page) {
        return $page->getDesignImagePath();
    }

    public function setImagePath(PoolsBuildingPage $page, $path) {
        $page->setDesignImagePath($path);
    }

}