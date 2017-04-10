<?php

namespace back\Settings\forms;

use app\models\Entity;
use app\models\Setting;
use back\forms\EntityForm;

class SettingsForm extends EntityForm {

    public $phone1 = '';
    public $phone2 = '';
    public $colnsultEmail = '';
    public $calcEmail = '';
    public $feedbackEmail = '';
    public $facebookLink = '';
    public $twitterLink = '';
    public $youtubeLink = '';
    public $countersCode = '';

    public function rules() {
        return [
            [
                [
                    'phone1', 'phone2', 'colnsultEmail', 'calcEmail', 'feedbackEmail',
                    'facebookLink', 'twitterLink', 'youtubeLink', 'countersCode',
                ],
                'safe'
            ],
            [
                [
                    'colnsultEmail', 'calcEmail', 'feedbackEmail',
                ],
                'email',
                'message' => 'Укажите корректный e-mail',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @param Setting $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->phone1 = $entity->getPhone1();
        $this->phone2 = $entity->getPhone2();
        $this->colnsultEmail = $entity->getColnsultEmail();
        $this->calcEmail = $entity->getCalcEmail();
        $this->feedbackEmail = $entity->getFeedbackEmail();
        $this->facebookLink = $entity->getFacebookLink();
        $this->twitterLink = $entity->getTwitterLink();
        $this->youtubeLink = $entity->getYoutubeLink();
        $this->countersCode = $entity->getCountersCode();
    }

    /**
     * @inheritdoc
     * @param Setting $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setPhone1($this->phone1);
        $entity->setPhone2($this->phone2);
        $entity->setColnsultEmail($this->colnsultEmail);
        $entity->setCalcEmail($this->calcEmail);
        $entity->setFeedbackEmail($this->feedbackEmail);
        $entity->setFacebookLink($this->facebookLink);
        $entity->setTwitterLink($this->twitterLink);
        $entity->setYoutubeLink($this->youtubeLink);
        $entity->setCountersCode($this->countersCode);
        return true;
    }

    /**
     * @inheritdoc
     */
    protected function createNewEntity() {
        return null;
    }

    /**
     * @inheritdoc
     */
    protected function createNewI18nForm() {
        return null;
    }
}