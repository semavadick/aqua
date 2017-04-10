<?php

namespace back\MainPage\controllers;

use app\models\MainPage;

abstract class FormController extends \back\controllers\FormController {

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageMainPage();
    }

    /** @return MainPage */
    protected function getPage() {
        return $this->getEntityManager()->getRepository('Models:MainPage')->findOneBy([]);
    }

}