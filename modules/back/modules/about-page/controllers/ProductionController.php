<?php

namespace back\AboutPage\controllers;

use back\AboutPage\forms\ProductionForm;

class ProductionController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new ProductionForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}