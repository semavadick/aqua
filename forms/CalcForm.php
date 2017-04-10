<?php

namespace app\forms;

use app\components\BitrixLeadsManager;
use Yii;
use yii\helpers\Html;
use yii\swiftmailer\Mailer;

/**
 * Форма для рассчёта стоимости бассейна
 */
class CalcForm extends Form {

    public $fullName = '';
    public $email = '';
    public $phone = '';
    public $region = '';

    public $poolType;
    public $position;
    public $purpose;
    public $waterHeating;
    public $length;
    public $width;
    public $depth;
    public $variableDepth;
    public $attractions;
    public $covering;
    public $ladder;
    public $lighting;
    public $sportEquipment;
    public $waterDisinfection;
    public $additionalDisinfection;
    public $captcha = '';

    /** @inheritdoc */
    public function rules() {
        return [
            [
                ['fullName', 'email', 'phone', 'region'],
                'required',
            ],
            ['email', 'email'],
            [
                [
                    'poolType', 'position', 'purpose', 'waterHeating',
                    'length', 'width', 'depth', 'variableDepth',
                    'attractions', 'covering', 'ladder', 'lighting',
                    'sportEquipment', 'waterDisinfection', 'additionalDisinfection'
                ],
                'safe',
            ],
            ['captcha', \app\validators\RecaptchaValidator::className()]
        ];
    }

    /** @inheritdoc */
    public function attributeLabels() {
        return [
            'fullName' => Yii::t('app', 'Your full name'),
            'email' => Yii::t('app', 'E-mail'),
            'phone' => Yii::t('app', 'Phone'),
            'region' => Yii::t('app', 'Your region'),
            'poolType' => Yii::t('app', 'Pool type'),
            'position' => Yii::t('app', 'Position'),
            'purpose' => Yii::t('app', 'Purpose'),
            'waterHeating' => Yii::t('app', 'Water heating'),
            'attractions' => Yii::t('app', 'Attractions'),
            'covering' => Yii::t('app', 'Protecting covering'),
            'ladder' => Yii::t('app', 'Ladder'),
            'lighting' => Yii::t('app', 'Lighting'),
            'sportEquipment' => Yii::t('app', 'Sport equipment'),
            'waterDisinfection' => Yii::t('app', 'Water disinfection'),
            'additionalDisinfection' => Yii::t('app', 'Additional disinfection'),
        ];
    }

    /**
     * @param string $attribute
     * @return array
     */
    public function getCheckboxOptions($attribute) {
        $options = [
            'poolType' => [
                Yii::t('app', 'Infinity'),
                Yii::t('app', 'Skimmer'),
            ],
            'position' => [
                Yii::t('app', 'Outdoor'),
                Yii::t('app', 'Indoor'),
            ],
            'purpose' => [
                Yii::t('app', 'Private'),
                Yii::t('app', 'Public'),
            ],
            'waterHeating' => [
                Yii::t('app', 'Boiler'),
                Yii::t('app', 'Electric heater'),
                Yii::t('app', 'Heating pump'),
            ],
            'attractions' => [
                Yii::t('app', 'Waterfall'),
                Yii::t('app', 'Backflow'),
                Yii::t('app', 'Geyser'),
                Yii::t('app', 'Air massage bench'),
                Yii::t('app', 'Air massage seat'),
                Yii::t('app', 'Sensor button'),
            ],
            'covering' => [
                Yii::t('app', 'Louvre covering'),
                Yii::t('app', 'Thermal blanker'),
            ],
            'ladder' => [
                Yii::t('app', 'Roman'),
                Yii::t('app', 'Build-in board'),
            ],
            'lighting' => [
                Yii::t('app', 'Halogen'),
                Yii::t('app', 'LED'),
                Yii::t('app', 'LED (RGB)'),
            ],
            'sportEquipment' => [
                Yii::t('app', 'Start stand'),
                Yii::t('app', 'Finishing panel'),
                Yii::t('app', 'Pointer rack'),
                Yii::t('app', 'Marking layout'),
                Yii::t('app', 'Dividing tracks'),
                Yii::t('app', 'Unreelers'),
                Yii::t('app', 'Robotic vacuum cleaner'),
            ],
            'waterDisinfection' => [
                Yii::t('app', 'Chlorine-based automatic dosing'),
                Yii::t('app', 'Oxygen-based automatic dosing'),
            ],
            'additionalDisinfection' => [
                Yii::t('app', 'Ozonation'),
                Yii::t('app', 'Ultraviolet water refinement'),
            ],
        ];
        return isset($options[$attribute]) ? $options[$attribute] : [];
    }

    /**
     * @param string $attribute
     * @return string|null
     */
    public function getOptionLabel($attribute) {
        if(!$this->hasProperty($attribute)) {
            return null;
        }
        $options = $this->getCheckboxOptions($attribute);
        $val = $this->$attribute;
        if(!is_array($val)) {
            return isset($options[$val]) ? $options[$val] : null;
        }
        $labels = [];
        foreach($val as $tVal) {
            if(!isset($options[$tVal])) {
                continue;
            }
            $labels[] = $options[$tVal];
        }
        return implode(', ', $labels);
    }

    /**
     * @return bool
     */
    public function sendRequest() {
        if(!$this->validate()) {
            return false;
        }

        $setting = $this->getSetting();
        /* @var Mailer $mailer */
        $mailer = Yii::$app->get('mailer');
        $message = $mailer->compose('managers/calc', [
            'form' => $this,
        ]);

        $result = $message
            ->setFrom($setting->getNoreplyEmail())
            ->setTo($setting->getCalcEmail())
            ->send();

        if($result) {
            $attrs = [
                'poolType', 'position', 'purpose',
                'waterHeating', 'attractions',
                'covering', 'ladder', 'lighting',
                'sportEquipment', 'waterDisinfection', 'additionalDisinfection',
            ];
            $attrs_str = '';
            if(!empty($this->length))
                $attrs_str .= Yii::t('app', 'Length, m:') . ' ' . $this->length . '; ';

            if(!empty($this->width))
                $attrs_str .= Yii::t('app', 'Width, m:') . ' ' .  $this->width . '; ';

            if(!empty($this->depth))
                $attrs_str .= Yii::t('app', 'Depth, m:') . ' ' . $this->depth . '; ';

            foreach($attrs as $attr){
                $attrs_str .= $this->getAttributeLabel($attr) . ': ' . Html::encode($this->getOptionLabel($attr)) .'; ';
            }

            $sendLeadResult = $this->sendLead(Yii::t('app', 'Building price request'), Yii::t('app', 'Building price request from url:') . ' ' . Yii::$app->request->referrer, $attrs_str);
        }
        return (!isset($sendLeadResult['error']) && $sendLeadResult['error'] != 201) ? false : true;
    }

    protected function sendLead($title, $description, $comment = '') {
        $leadsManager = Yii::$app->get('bitrixLeadsManager');
        $leadData = [
            BitrixLeadsManager::FIELD_SOURCE_ID => 'WEB',
            BitrixLeadsManager::FIELD_ASSIGNED_BY_ID => 8,
            BitrixLeadsManager::FIELD_TITLE => $title,
            BitrixLeadsManager::FIELD_DESCRIPTION => $description,
            BitrixLeadsManager::FIELD_EMAIL => $this->email,
            BitrixLeadsManager::FIELD_NAME => $this->fullName,
            BitrixLeadsManager::FIELD_PHONE => $this->phone,
            BitrixLeadsManager::FIELD_ADDRESS => $this->region,
            BitrixLeadsManager::FIELD_COMMENT => $comment
        ];
        $response = $leadsManager->sendRequest($leadData);
        return $response;
    }

}