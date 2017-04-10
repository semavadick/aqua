<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией преимуществ типов бассейнов
 * @ORM\Entity()
 */
class TypeAdvantageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\TypeAdvantage", inversedBy="i18ns")
     * @ORM\JoinColumn(name="advantageId", referencedColumnName="id")
     */
    protected $advantage;

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

    /** @return TypeAdvantage */
    public function getAdvantage() { return $this->advantage; }

    /** @param TypeAdvantage $advantage */
    public function setAdvantage($advantage) { $this->advantage = $advantage; }

}