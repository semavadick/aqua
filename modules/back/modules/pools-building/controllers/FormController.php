<?php

namespace back\PoolsBuilding\controllers;

use app\models\PoolsBuildingPage;

abstract class FormController extends \back\controllers\FormController {

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManagePoolsBuildingPage();
    }

    /** @return PoolsBuildingPage */
    protected function getPage() {
        return $this->getEntityManager()->getRepository('Models:PoolsBuildingPage')->findOneBy([]);
    }

}