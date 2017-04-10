<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией страницы Строительство бассейнов
 * @ORM\Entity()
 */
class PoolsBuildingPageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $title = '';

    /** @ORM\Column(type="string") */
    protected $metaKeywords = '';

    /** @ORM\Column(type="string") */
    protected $metaDescription = '';

    /** @ORM\Column(type="string") */
    protected $projectTitle = '';

    /** @ORM\Column(type="text") */
    protected $projectText = '';

    /** @ORM\Column(type="string") */
    protected $projectPresentationPath = '';

    /** @ORM\Column(type="string") */
    protected $designTitle = '';

    /** @ORM\Column(type="text") */
    protected $designText = '';

    /** @ORM\Column(type="string") */
    protected $designPresentationPath = '';

    /** @ORM\Column(type="string") */
    protected $buildingTitle = '';

    /** @ORM\Column(type="text") */
    protected $buildingText = '';

    /** @ORM\Column(type="string") */
    protected $buildingPresentationPath = '';

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
    public function getProjectTitle() { return $this->projectTitle; }

    /** @param string $projectTitle */
    public function setProjectTitle($projectTitle) { $this->projectTitle = $projectTitle; }

    /** @return string */
    public function getProjectText() { return $this->projectText; }

    /** @param string $projectText */
    public function setProjectText($projectText) { $this->projectText = $projectText; }

    /** @return string */
    public function getDesignTitle() { return $this->designTitle; }

    /** @param string $designTitle */
    public function setDesignTitle($designTitle) { $this->designTitle = $designTitle; }

    /** @return string */
    public function getDesignText() { return $this->designText; }

    /** @param string $designText */
    public function setDesignText($designText) { $this->designText = $designText; }

    /** @return string */
    public function getBuildingTitle() { return $this->buildingTitle; }

    /** @param string $buildingTitle */
    public function setBuildingTitle($buildingTitle) { $this->buildingTitle = $buildingTitle; }

    /** @return string */
    public function getBuildingText() { return $this->buildingText; }

    /** @param string $buildingText */
    public function setBuildingText($buildingText) { $this->buildingText = $buildingText; }

    /** @return string */
    public function getBuildingPresentationPath() { return $this->buildingPresentationPath; }

    /** @param string $buildingPresentationPath */
    public function setBuildingPresentationPath($buildingPresentationPath) { $this->buildingPresentationPath = $buildingPresentationPath; }

    /** @return string */
    public function getProjectPresentationPath() { return $this->projectPresentationPath; }

    /** @param string $projectPresentationPath */
    public function setProjectPresentationPath($projectPresentationPath) { $this->projectPresentationPath = $projectPresentationPath; }

    /** @return string */
    public function getDesignPresentationPath() { return $this->designPresentationPath; }

    /** @param string $designPresentationPath */
    public function setDesignPresentationPath($designPresentationPath) { $this->designPresentationPath = $designPresentationPath; }

}