<?php

namespace back\AboutPage\controllers;

use back\AboutPage\forms\CompetenceForm;

class CompetenceController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new CompetenceForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}