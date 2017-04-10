<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией баннеров
 * @ORM\Entity()
 */
class MainPageBannerI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\MainPageBanner", inversedBy="i18ns")
     * @ORM\JoinColumn(name="bannerId", referencedColumnName="id")
     */
    protected $banner;

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

    /** @return Language */
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

    /** @return MainPageBanner */
    public function getBanner() { return $this->banner; }

    /** @param MainPageBanner $banner */
    public function setBanner($banner) { $this->banner = $banner; }


}