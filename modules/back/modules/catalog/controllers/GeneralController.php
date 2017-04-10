<?php

namespace back\Catalog\controllers;

use app\models\CatalogPage;
use back\Catalog\forms\GeneralForm;
use back\controllers\FormController;

class GeneralController extends FormController {

    /** @inheritdoc */
    protected function getForm() {
        $form = new GeneralForm();
        /** @var CatalogPage $page */
        $page = $this->getEntityManager()->find('Models:CatalogPage', 0);
        $form->setEntity($page);
        return $form;
    }

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageCatalog();
    }

}