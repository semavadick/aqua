<?php

namespace back\AboutPage\controllers;

use app\models\AboutPage;

abstract class FormController extends \back\controllers\FormController {

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageAboutPage();
    }

    /** @return AboutPage */
    protected function getPage() {
        return $this->getEntityManager()->getRepository('Models:AboutPage')->findOneBy([]);
    }

}