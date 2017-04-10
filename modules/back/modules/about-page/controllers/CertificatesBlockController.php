<?php

namespace back\AboutPage\controllers;

use back\AboutPage\forms\CertificatesBlockForm;

class CertificatesBlockController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new CertificatesBlockForm();
        $form->setEntity($this->getPage());
        return $form;
    }

}