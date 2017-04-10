<?php

namespace back\PoolsBuilding\controllers;

use app\models\PoolsBuildingStatic;
use back\PoolsBuilding\forms\RebuildingForm;

class RebuildingController extends \back\controllers\FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new RebuildingForm();
        /** @var PoolsBuildingStatic $poolsBuildingStatic */
        $poolsBuildingStatic = $this->getPage();
        $form->setEntity($poolsBuildingStatic);
        return $form;
    }
    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManagePoolsBuildingPage();
    }

    /** @return PoolsBuildingStatic */
    protected function getPage() {
        return $this->getEntityManager()->find('Models:PoolsBuildingStatic', PoolsBuildingStatic::REBUILDING_ID);
    }

}