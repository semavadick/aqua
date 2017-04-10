<?php

namespace back\Services\forms;

use app\models\Service;

class ExclusiveForm extends ServiceForm {

    protected function createNewI18nForm() {
        return new ExclusiveI18nForm();
    }

    protected function hasBgImage() {
        return true;
    }

    protected function hasTypes() {
        return true;
    }
}