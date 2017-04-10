<?php

namespace back\Services\controllers;


use app\models\Service;
use back\Services\forms\MaintenanceForm;

class MaintenanceController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new MaintenanceForm();
        /** @var Service $service */
        $service = $this->getEntityManager()->find('Models:Service', Service::MAINTENANCE_ID);
        $form->setEntity($service);
        return $form;
    }

}