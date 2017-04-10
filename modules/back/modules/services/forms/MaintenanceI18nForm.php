<?php

namespace back\Services\forms;

class MaintenanceI18nForm extends ServiceI18nForm {

    protected function hasAdditDescription() {
        return false;
    }

    protected function hasVideo() {
        return false;
    }
}