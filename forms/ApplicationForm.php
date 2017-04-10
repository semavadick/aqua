<?php

namespace app\forms;

use app\components\BitrixLeadsManager;
use Yii;

/**
 * Форма для отправления заявки
 */
class ApplicationForm extends ContactForm {

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getFeedbackEmail(), 'managers/application');
        if($sendemail) {
            $result = $this->sendLead(Yii::t('app', 'Contact request from site'), Yii::t('app', 'Top header form'));
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

}