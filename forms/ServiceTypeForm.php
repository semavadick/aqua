<?php

namespace app\forms;

use app\repositories\SettingsRepository;
use Yii;
use back\helpers\HandyFile;
use app\validators\ModelFile;

/**
 * Форма для запроса на расчет изделия
 */
class ServiceTypeForm extends ContactForm {

    /**
     * @var HandyFile
     */
    public $uFile;

    public $typeTitle;

    /** @inheritdoc */
    public function rules() {
        $parent = parent::rules();
        $rules = array_merge($parent, [
            ['uFile', ModelFile::className()],
            ['typeTitle','safe']
        ]);
        return $rules;
    }

    /** @param array */
    public function loadFile($data) {
        if(!empty($data['uFile']['tmp_name']) && !empty($data['uFile']['name'])) {
            $this->uFile = HandyFile::createFromPath($data['uFile']['tmp_name'], $data['uFile']['name']);
        } else {
            $this->uFile = null;
        }
    }

    /** @return bool */
    public function sendRequest() {
        $sendemail = $this->sendRequestViaEmail($this->getSetting()->getFeedbackEmail(), 'managers/serviceType');
        if($sendemail) {
            $result = $this->sendLead(Yii::t('app', 'Request exclusive product'), Yii::t('app', 'Request exclusive from Exclusive service page'), 8, Yii::t('app','Exclusive service type:') . ' ' . $this->typeTitle);
        }
        return (!isset($result['error']) && $result['error'] != 201) ? false : true;
    }

    protected function sendRequestViaEmail($email, $messageView) {
        if(!$this->validate()) {
            return false;
        }
        $setting = $this->getSetting();

        /* @var Mailer $mailer */
        $mailer = Yii::$app->get('mailer');
        $message = $mailer->compose($messageView, [
            'fullName' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
            'typeTitle' => $this->typeTitle
        ]);
        $message->setFrom($setting->getNoreplyEmail())->setTo($email);
        if(!empty($this->uFile)) {
            $message->attachContent($this->uFile->getBlob(), [
                'fileName' => 'draft-' . $this->email . '.' . $this->uFile->getExtension()
            ]);
        }
        $result = $message->send();
        return $result;
    }
}