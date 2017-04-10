<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingPageI18n;

class ProjectI18nForm extends ServiceI18nForm {

    public function getTitle(PoolsBuildingPageI18n $i18n) {
        return $i18n->getProjectTitle();
    }

    public function setTitle(PoolsBuildingPageI18n $i18n, $title) {
        $i18n->setProjectTitle($title);
    }

    public function getText(PoolsBuildingPageI18n $i18n) {
        return $i18n->getProjectText();
    }

    public function setText(PoolsBuildingPageI18n $i18n, $text) {
        $i18n->setProjectText($text);
    }

    public function getPresentationPath(PoolsBuildingPageI18n $i18n) {
        return $i18n->getProjectPresentationPath();
    }

    public function setPresentationPath(PoolsBuildingPageI18n $i18n, $path) {
        $i18n->setProjectPresentationPath($path);
    }

}