<?php

namespace back\AboutPage\controllers;

use back\AboutPage\forms\HistoryForm;

class HistoryController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new HistoryForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}