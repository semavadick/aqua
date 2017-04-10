<?php

namespace back\Services\controllers;


use app\models\Service;
use back\Services\forms\ExclusiveForm;

class ExclusiveController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new ExclusiveForm();
        /** @var Service $service */
        $service = $this->getEntityManager()->find('Models:Service', Service::EXCLUSIVE_ID);
        $form->setEntity($service);
        return $form;
    }

}