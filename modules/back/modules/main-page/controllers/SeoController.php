<?php

namespace back\MainPage\controllers;

use back\MainPage\forms\SeoForm;

class SeoController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new SeoForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}