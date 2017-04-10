<?php

namespace back\PoolsBuilding\controllers;

use back\PoolsBuilding\forms\DesignForm;

class DesignController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new DesignForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}