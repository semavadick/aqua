<?php

namespace back\PoolsBuilding\controllers;

use back\PoolsBuilding\forms\BuildingForm;

class BuildingController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new BuildingForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}