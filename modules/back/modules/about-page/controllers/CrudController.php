<?php

namespace back\AboutPage\controllers;

abstract class CrudController extends \back\controllers\CrudController {

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageAboutPage();
    }

}