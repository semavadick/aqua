<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией баннеров
 * @ORM\Entity()
 */
class MainPageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $title = '';

    /** @ORM\Column(type="string") */
    protected $catalogImagePath = '';

    const CATALOG_IMAGE_WIDTH = 277;
    const CATALOG_IMAGE_HEIGHT = 201;

    /** @ORM\Column(type="string") */
    protected $catalogFilePath = '';

    /** @ORM\Column(type="string") */
    protected $metaKeywords = '';

    /** @ORM\Column(type="string") */
    protected $metaDescription = '';

    /** @ORM\Column(type="string") */
    protected $aboutTitle = '';

    /** @ORM\Column(type="string") */
    protected $aboutText = '';

    /** @ORM\Column(type="text") */
    protected $aboutVideo = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return string */
    public function getTitle() { return $this->title; }

    /** @param string $title */
    public function setTitle($title) { $this->title = $title; }

    /** @return string */
    public function getMetaKeywords() { return $this->metaKeywords; }

    /** @param string $metaKeywords */
    public function setMetaKeywords($metaKeywords) { $this->metaKeywords = $metaKeywords; }

    /** @return string */
    public function getMetaDescription() { return $this->metaDescription; }

    /** @param string $metaDescription */
    public function setMetaDescription($metaDescription) { $this->metaDescription = $metaDescription; }

    /** @return string */
    public function getAboutText() { return $this->aboutText; }

    /** @param string $aboutText */
    public function setAboutText($aboutText) { $this->aboutText = $aboutText; }

    /** @return string */
    public function getAboutTitle() { return $this->aboutTitle; }

    /** @param string $aboutTitle */
    public function setAboutTitle($aboutTitle) { $this->aboutTitle = $aboutTitle; }

    /** @return string */
    public function getCatalogImagePath() { return $this->catalogImagePath; }

    /** @param string $catalogImagePath */
    public function setCatalogImagePath($catalogImagePath) { $this->catalogImagePath = $catalogImagePath; }

    /** @return string */
    public function getCatalogFilePath() { return $this->catalogFilePath; }

    /** @param string $catalogFilePath */
    public function setCatalogFilePath($catalogFilePath) { $this->catalogFilePath = $catalogFilePath; }

    /** @return string */
    public function getAboutVideo() { return $this->aboutVideo; }

    /** @param string $aboutVideo */
    public function setAboutVideo($aboutVideo) { $this->aboutVideo = $aboutVideo; }

}