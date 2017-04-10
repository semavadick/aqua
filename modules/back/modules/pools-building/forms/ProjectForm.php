<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingPage;

class ProjectForm extends ServiceForm {

    protected function createNewI18nForm() {
        return new ProjectI18nForm();
    }

    public function getIconPath(PoolsBuildingPage $page) {
        return $page->getProjectIconPath();
    }

    public function setIconPath(PoolsBuildingPage $page, $path) {
        $page->setProjectIconPath($path);
    }

    public function getImagePath(PoolsBuildingPage $page) {
        return $page->getProjectImagePath();
    }

    public function setImagePath(PoolsBuildingPage $page, $path) {
        $page->setProjectImagePath($path);
    }

}