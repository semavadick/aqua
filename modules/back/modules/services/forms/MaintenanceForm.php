<?php

namespace back\Services\forms;

class MaintenanceForm extends ServiceForm {

    protected function createNewI18nForm() {
        return new MaintenanceI18nForm();
    }

    protected function hasBgImage() {
        return false;
    }

    protected function hasTypes() {
        return false;
    }
}