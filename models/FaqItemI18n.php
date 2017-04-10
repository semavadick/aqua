<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией элементов FAQ
 * @ORM\Entity()
 */
class FaqItemI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\FaqItem", inversedBy="i18ns")
     * @ORM\JoinColumn(name="itemId", referencedColumnName="id")
     */
    protected $item;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $question = '';

    /** @ORM\Column(type="text") */
    protected $answer = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return FaqItem */
    public function getItem() { return $this->item; }

    /** @param FaqItem $item */
    public function setItem($item) { $this->item = $item; }

    /** @return string */
    public function getQuestion() { return $this->question; }

    /** @param string $question */
    public function setQuestion($question) { $this->question = $question; }

    /** @return string */
    public function getAnswer() { return $this->answer; }

    /** @param string $answer */
    public function setAnswer($answer) { $this->answer = $answer; }

}