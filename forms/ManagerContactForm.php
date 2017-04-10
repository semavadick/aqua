<?php

namespace app\forms;

use Yii;

/**
 * Форма для запроса связи с менеджером
 */
class ManagerContactForm extends ContactForm {

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getFeedbackEmail(), 'managers/managerContact');
        if($sendemail) {

            $result = $this->sendLead(Yii::t('app', 'Manager contact request'), Yii::t('app', 'Main page in about section'));
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

}