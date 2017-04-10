<?php

namespace back\Settings\controllers;

use app\models\Setting;
use back\controllers\FormController;
use back\Settings\forms\SettingsForm;

class SettingsController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new SettingsForm();
        /** @var Setting $setting */
        $setting = $this->getEntityManager()->getRepository('Models:Setting')->findOneBy([]);
        $form->setEntity($setting);
        return $form;
    }

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageSettings();
    }

}