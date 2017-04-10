<?php

namespace app\forms;

use Yii;

/**
 * Форма для запроса услуги Обслуживание бассейнов
 */
class MaintenanceRequestForm extends ContactForm {

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getFeedbackEmail(), 'managers/maintenanceRequest');
        if($sendemail) {
            $result = $this->sendLead(Yii::t('app', 'Maintenance pool request'), Yii::t('app', 'Service form in maintenance section'), 8);
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

}