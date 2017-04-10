<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией слайдов
 * @ORM\Entity()
 */
class MainPageSlideI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\MainPageSlide", inversedBy="i18ns")
     * @ORM\JoinColumn(name="slideId", referencedColumnName="id")
     */
    protected $slide;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $text = '';

    /** @ORM\Column(type="string") */
    protected $link = '';

    /** @return Language|null */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return string */
    public function getText() { return $this->text; }

    /** @param string $text */
    public function setText($text) { $this->text = $text; }

    /** @return string */
    public function getLink() { return $this->link; }

    /** @param string $link */
    public function setLink($link) { $this->link = $link; }

    /** @return MainPageSlide|null */
    public function getSlide() { return $this->slide; }

    /** @param MainPageSlide $slide */
    public function setSlide($slide) { $this->slide = $slide; }

}