<?php

namespace back\PoolsBuilding\controllers;

use back\PoolsBuilding\forms\SeoForm;

class SeoController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new SeoForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}