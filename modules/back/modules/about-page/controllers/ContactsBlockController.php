<?php

namespace back\AboutPage\controllers;

use back\AboutPage\forms\ContactsBlockForm;

class ContactsBlockController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new ContactsBlockForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}