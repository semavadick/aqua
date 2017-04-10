<?php

namespace back\AboutPage\controllers;

use back\AboutPage\forms\AdvantagesBlockForm;

class AdvantagesBlockController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new AdvantagesBlockForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}