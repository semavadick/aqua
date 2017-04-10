<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией этапов истории
 * @ORM\Entity()
 */
class HistoryStageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\HistoryStage", inversedBy="i18ns")
     * @ORM\JoinColumn(name="stageId", referencedColumnName="id")
     */
    protected $stage;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="text") */
    protected $text = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return string */
    public function getText() { return $this->text; }

    /** @param string $text */
    public function setText($text) { $this->text = $text; }

    /** @return HistoryStage */
    public function getStage() { return $this->stage; }

    /** @param HistoryStage $stage */
    public function setStage($stage) { $this->stage = $stage; }

}