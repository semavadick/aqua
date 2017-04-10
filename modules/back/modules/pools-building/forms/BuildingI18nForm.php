<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingPageI18n;

class BuildingI18nForm extends ServiceI18nForm {

    public function getTitle(PoolsBuildingPageI18n $i18n) {
        return $i18n->getBuildingTitle();
    }

    public function setTitle(PoolsBuildingPageI18n $i18n, $title) {
        $i18n->setBuildingTitle($title);
    }

    public function getText(PoolsBuildingPageI18n $i18n) {
        return $i18n->getBuildingText();
    }

    public function setText(PoolsBuildingPageI18n $i18n, $text) {
        $i18n->setBuildingText($text);
    }

    public function getPresentationPath(PoolsBuildingPageI18n $i18n) {
        return $i18n->getBuildingPresentationPath();
    }

    public function setPresentationPath(PoolsBuildingPageI18n $i18n, $path) {
        $i18n->setBuildingPresentationPath($path);
    }

}