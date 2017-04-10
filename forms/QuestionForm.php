<?php

namespace app\forms;

use app\components\BitrixLeadsManager;
use Yii;
use yii\swiftmailer\Mailer;

/**
 * Форма для вопроса
 */
class QuestionForm extends Form {

    public $fullName = '';
    public $email = '';
    public $phone = '';
    public $question = '';
    public $captcha = '';

    /** @inheritdoc */
    public function rules() {
        return [
            [
                ['fullName', 'email', 'phone', 'question'],
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
            'question' => Yii::t('app', 'Your question'),
        ];
    }

    public function sendQuestion() {
        if(!$this->validate()) {
            return false;
        }
        $setting = $this->getSetting();
        /* @var Mailer $mailer */
        $mailer = Yii::$app->get('mailer');
        $message = $mailer->compose('managers/question', [
            'fullName' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
            'question' => $this->question,
        ]);
        $result = $message
            ->setFrom($setting->getNoreplyEmail())
            ->setTo($setting->getFeedbackEmail())
            ->send();
        if($result) {
            $sendLeadResult = $this->sendLead(Yii::t('app', 'Question from site'), Yii::t('app', 'Building page form'));
        }
        return (!isset($sendLeadResult['error']) && $sendLeadResult['error'] != 201) ? false : true;
    }

    protected function sendLead($title, $description) {
        $leadsManager = Yii::$app->get('bitrixLeadsManager');
        $leadData = [
            BitrixLeadsManager::FIELD_SOURCE_ID => 'WEB',
            BitrixLeadsManager::FIELD_ASSIGNED_BY_ID => 8,
            BitrixLeadsManager::FIELD_TITLE => $title,
            BitrixLeadsManager::FIELD_DESCRIPTION => $description,
            BitrixLeadsManager::FIELD_EMAIL => $this->email,
            BitrixLeadsManager::FIELD_NAME => $this->fullName,
            BitrixLeadsManager::FIELD_PHONE => $this->phone,
            BitrixLeadsManager::FIELD_COMMENT => $this->question
        ];
        $response = $leadsManager->sendRequest($leadData);
        return $response;
    }

}