<?php

namespace back\Services\controllers;

abstract class FormController extends \back\controllers\FormController {

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageServices();
    }
}