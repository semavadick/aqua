<?php

namespace app\forms;

use app\components\BitrixLeadsManager;
use app\repositories\SettingsRepository;
use Yii;
use yii\swiftmailer\Mailer;

/**
 * Форма связи
 */
abstract class ContactForm extends Form {

    public $fullName = '';
    public $email = '';
    public $phone = '';
    public $captcha = '';

    /** @inheritdoc */
    public function rules() {
        return [
            [
                ['fullName', 'email', 'phone'],
                'required',
            ],
            ['email', 'email'],
            ['captcha', \app\validators\RecaptchaValidator::className()]
        ];
    }

    /** @inheritdoc */
    public function attributeLabels() {
        return [
            'fullName' => Yii::t('app', 'Your full name'),
            'email' => Yii::t('app', 'E-mail'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    protected function sendRequestViaEmail($email, $messageView) {
        if(!$this->validate()) {
            return false;
        }
        $setting = SettingsRepository::getInstance()->findSetting();
        /* @var Mailer $mailer */
        $mailer = Yii::$app->get('mailer');
        $message = $mailer->compose($messageView, [
            'fullName' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        $result = $message
            ->setFrom($setting->getNoreplyEmail())
            ->setTo($email)
            ->send();

        return $result;
    }

    protected function sendLead($title, $description, $assigned_id = 22, $comment = false) {
        $leadsManager = Yii::$app->get('bitrixLeadsManager');
        $leadData = [
            BitrixLeadsManager::FIELD_SOURCE_ID => 'WEB',
            BitrixLeadsManager::FIELD_ASSIGNED_BY_ID => $assigned_id,
            BitrixLeadsManager::FIELD_TITLE => $title,
            BitrixLeadsManager::FIELD_DESCRIPTION => $description,
            BitrixLeadsManager::FIELD_EMAIL => $this->email,
            BitrixLeadsManager::FIELD_NAME => $this->fullName,
            BitrixLeadsManager::FIELD_PHONE => $this->phone
        ];
        if(!empty($comment))
            $leadData[BitrixLeadsManager::FIELD_COMMENT] = $comment;

        $response = $leadsManager->sendRequest($leadData);
        return $response;
    }

}