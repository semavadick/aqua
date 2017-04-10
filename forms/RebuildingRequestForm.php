<?php

namespace app\forms;

use Yii;

/**
 * Форма для отправления заявки
 */
class RebuildingRequestForm extends ContactForm {

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getFeedbackEmail(), 'managers/rebuilding');
        if($sendemail) {
            $result = $this->sendLead(Yii::t('app', 'Request rebuilding'), Yii::t('app', 'Request rebuilding from Rebuilding page'), 8);
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

}