<?php

namespace app\forms;

use Yii;

/**
 * Форма для запроса консультации
 */
class ConsultForm extends ContactForm {

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getColnsultEmail(), 'managers/consult');
        if($sendemail) {
            $result = $this->sendLead(Yii::t('app', 'Manager contact request'), Yii::t('app', 'Building page form'), 8);
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

}