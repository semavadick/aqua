<?php

namespace back\PoolsBuilding\forms;

use app\models\PoolsBuildingPageI18n;

class DesignI18nForm extends ServiceI18nForm {

    public function getTitle(PoolsBuildingPageI18n $i18n) {
        return $i18n->getDesignTitle();
    }

    public function setTitle(PoolsBuildingPageI18n $i18n, $title) {
        $i18n->setDesignTitle($title);
    }

    public function getText(PoolsBuildingPageI18n $i18n) {
        return $i18n->getDesignText();
    }

    public function setText(PoolsBuildingPageI18n $i18n, $text) {
        $i18n->setDesignText($text);
    }

    public function getPresentationPath(PoolsBuildingPageI18n $i18n) {
        return $i18n->getDesignPresentationPath();
    }

    public function setPresentationPath(PoolsBuildingPageI18n $i18n, $path) {
        $i18n->setDesignPresentationPath($path);
    }

}