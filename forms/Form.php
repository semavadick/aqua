<?php

namespace app\forms;

use app\models\Setting;
use app\repositories\SettingsRepository;
use yii\base\Model;

/**
 * Базовый класс форм
 */
abstract class Form extends Model {

    /** @return Setting */
    protected function getSetting() {
        return SettingsRepository::getInstance()->findSetting();
    }

}