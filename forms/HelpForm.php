<?php

namespace app\forms;

use Yii;

/**
 * Форма для запроса помощи в выборе
 */
class HelpForm extends ContactForm {

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getFeedbackEmail(), 'managers/help');
        if($sendemail) {
            $result = $this->sendLead(Yii::t('app', 'Store product help request'), Yii::t('app', 'Store product help request from url: ').Yii::$app->request->referrer);
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

}