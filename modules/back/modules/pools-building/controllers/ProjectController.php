<?php

namespace back\PoolsBuilding\controllers;

use back\PoolsBuilding\forms\ProjectForm;

class ProjectController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new ProjectForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}