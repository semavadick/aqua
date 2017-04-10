<?php

namespace back\MainPage\controllers;

use back\MainPage\forms\AboutForm;

class AboutController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new AboutForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}