<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use Yii;

/**
 * Класс для работы с настройками
 * @ORM\Entity(repositoryClass="app\repositories\SettingsRepository")
 * @ORM\Table(name="`Setting`")
 */
class Setting extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string Телефон 1
     */
    protected $phone1;

    /**
     * @ORM\Column(type="string")
     * @var string Телефон 2
     */
    protected $phone2;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $colnsultEmail;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $calcEmail;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $feedbackEmail;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $facebookLink;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $twitterLink;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $youtubeLink;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $countersCode = '';

    /** @return array */
    public function getI18ns() { return []; }

    /** @return string */
    public function getPhone1() { return $this->phone1; }

    /** @param string $phone1 */
    public function setPhone1($phone1) { $this->phone1 = $phone1; }

    /** @return string */
    public function getPhone2() { return $this->phone2; }

    /** @param string $phone2 */
    public function setPhone2($phone2) { $this->phone2 = $phone2; }

    /** @return string */
    public function getColnsultEmail() { return $this->colnsultEmail; }

    /** @param string $colnsultEmail */
    public function setColnsultEmail($colnsultEmail) { $this->colnsultEmail = $colnsultEmail; }

    /** @return string */
    public function getCalcEmail() { return $this->calcEmail; }

    /** @param string $calcEmail */
    public function setCalcEmail($calcEmail) { $this->calcEmail = $calcEmail; }

    /** @return string */
    public function getFeedbackEmail() { return $this->feedbackEmail; }

    /** @param string $feedbackEmail */
    public function setFeedbackEmail($feedbackEmail) { $this->feedbackEmail = $feedbackEmail; }

    /** @return string */
    public function getFacebookLink() { return $this->facebookLink; }

    /** @param string $facebookLink */
    public function setFacebookLink($facebookLink) { $this->facebookLink = $facebookLink; }

    /** @return string */
    public function getTwitterLink() { return $this->twitterLink; }

    /** @param string $twitterLink */
    public function setTwitterLink($twitterLink) { $this->twitterLink = $twitterLink; }

    /** @return string */
    public function getYoutubeLink() { return $this->youtubeLink; }

    /** @param string $youtubeLink */
    public function setYoutubeLink($youtubeLink) { $this->youtubeLink = $youtubeLink; }

    /** @return string */
    public function getCountersCode() { return $this->countersCode; }

    /** @param string $countersCode */
    public function setCountersCode($countersCode) { $this->countersCode = $countersCode; }

    /** @return string */
    public function getNoreplyEmail() {
        $email = (!empty(Yii::$app->params['mailer']) && !empty(Yii::$app->params['mailer']['support']['email'])) ? Yii::$app->params['mailer']['support']['email'] : '';
        $name = (!empty(Yii::$app->params['mailer']) && !empty(Yii::$app->params['mailer']['support']['name'])) ? Yii::$app->params['mailer']['support']['name'] : '';
        $parts = explode('@', $email);
        if(count($parts) >= 2) {
            $host = $parts[1];
        } else {
            $host = Yii::$app->getRequest()->getUserHost();
        }
        if(empty($host)) {
            $host = 'example.com';
        }
        return ['noreply@' . $host => $name];
    }

}