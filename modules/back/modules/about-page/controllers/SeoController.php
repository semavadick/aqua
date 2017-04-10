<?php

namespace back\AboutPage\controllers;

use back\AboutPage\forms\SeoForm;

class SeoController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new SeoForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}