<?php

namespace app\repositories;

use app\models\Setting;

/**
 * Репозиторий настроек
 */
class SettingsRepository extends Repository {

    /** @return SettingsRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Setting'); }

    /** @return Setting */
    public function findSetting() {
        return $this->find(0);
    }
}
