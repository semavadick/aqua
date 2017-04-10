<?php

namespace app\forms;

use Yii;

/**
 * Форма для отправления запроса информации о скидке
 */
class DiscountForm extends ContactForm {

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getFeedbackEmail(), 'managers/discount');
        if($sendemail) {
            $result = $this->sendLead(Yii::t('app', 'Sale price request'), Yii::t('app', 'Sale price request from store product'));
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

}