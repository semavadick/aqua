<?php

namespace back\Services\forms;

use app\models\ServiceI18n;

class ExclusiveI18nForm extends ServiceI18nForm {

    protected function hasAdditDescription() {
        return true;
    }

    protected function hasVideo() {
        return true;
    }
}