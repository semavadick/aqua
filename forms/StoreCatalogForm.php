<?php

namespace app\forms;

use Yii;

/**
 * Форма для запроса каталога магазина
 */
class StoreCatalogForm extends ContactForm {

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getFeedbackEmail(), 'managers/storeCatalog');
        if($sendemail) {
            $result = $this->sendLead(Yii::t('app', 'Free catalog request from site'), Yii::t('app', 'Store page form'));
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

}