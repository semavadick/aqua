<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией страницы О компании
 * @ORM\Entity()
 */
class AboutPageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $menuName = '';

    /** @ORM\Column(type="string") */
    protected $title = '';

    /** @ORM\Column(type="string") */
    protected $metaKeywords = '';

    /** @ORM\Column(type="string") */
    protected $metaDescription = '';

    /** @ORM\Column(type="string") */
    protected $historyMenuName = '';

    /** @ORM\Column(type="string") */
    protected $historyImagePath = '';

    /** @ORM\Column(type="string") */
    protected $competenceMenuName = '';

    /** @ORM\Column(type="string") */
    protected $competenceTitle = '';

    /** @ORM\Column(type="text") */
    protected $competenceText = '';

    /** @ORM\Column(type="string") */
    protected $productionMenuName = '';

    /** @ORM\Column(type="string") */
    protected $productionTitle = '';

    /** @ORM\Column(type="text") */
    protected $productionText = '';

    /** @ORM\Column(type="string") */
    protected $advantagesMenuName = '';

    /** @ORM\Column(type="string") */
    protected $advantagesTitle = '';

    /** @ORM\Column(type="string") */
    protected $certificatesMenuName = '';

    /** @ORM\Column(type="string") */
    protected $certificatesTitle = '';

    /** @ORM\Column(type="string") */
    protected $newsMenuName = '';

    /** @ORM\Column(type="string") */
    protected $newsTitle = '';

    /** @ORM\Column(type="string") */
    protected $contactsMenuName = '';

    /** @ORM\Column(type="string") */
    protected $contactsTitle = '';

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
    public function getMenuName() { return $this->menuName; }

    /** @param string $menuName */
    public function setMenuName($menuName) { $this->menuName = $menuName; }

    /** @return string */
    public function getHistoryMenuName() { return $this->historyMenuName; }

    /** @param string $historyMenuName */
    public function setHistoryMenuName($historyMenuName) { $this->historyMenuName = $historyMenuName; }

    /** @return string */
    public function getHistoryImagePath() { return $this->historyImagePath; }


    /** @return string */
    public function getHistoryImageUrl() { return $this->historyImagePath; }

    /** @param string $historyImagePath */
    public function setHistoryImagePath($historyImagePath) { $this->historyImagePath = $historyImagePath; }

    /** @return string */
    public function getCompetenceMenuName() { return $this->competenceMenuName; }

    /** @param string $competenceMenuName */
    public function setCompetenceMenuName($competenceMenuName) { $this->competenceMenuName = $competenceMenuName; }

    /** @return string */
    public function getCompetenceTitle() { return $this->competenceTitle; }

    /** @param string $competenceTitle */
    public function setCompetenceTitle($competenceTitle) { $this->competenceTitle = $competenceTitle; }

    /** @return string */
    public function getCompetenceText() { return $this->competenceText; }

    /** @param string $competenceText */
    public function setCompetenceText($competenceText) { $this->competenceText = $competenceText; }

    /** @return string */
    public function getProductionMenuName() { return $this->productionMenuName; }

    /** @param string $productionMenuName */
    public function setProductionMenuName($productionMenuName) { $this->productionMenuName = $productionMenuName; }

    /** @return string */
    public function getProductionTitle() { return $this->productionTitle; }

    /** @param string $productionTitle */
    public function setProductionTitle($productionTitle) { $this->productionTitle = $productionTitle; }

    /** @return string */
    public function getProductionText() { return $this->productionText; }

    /** @param string $productionText */
    public function setProductionText($productionText) { $this->productionText = $productionText; }

    /** @return string */
    public function getAdvantagesMenuName() { return $this->advantagesMenuName; }

    /** @param string $advantagesMenuName */
    public function setAdvantagesMenuName($advantagesMenuName) { $this->advantagesMenuName = $advantagesMenuName; }

    /** @return string */
    public function getAdvantagesTitle() { return $this->advantagesTitle; }

    /** @param string $advantagesTitle */
    public function setAdvantagesTitle($advantagesTitle) { $this->advantagesTitle = $advantagesTitle; }

    /** @return string */
    public function getCertificatesMenuName() { return $this->certificatesMenuName; }

    /** @param string $certificatesMenuName */
    public function setCertificatesMenuName($certificatesMenuName) { $this->certificatesMenuName = $certificatesMenuName; }

    /** @return string */
    public function getCertificatesTitle() { return $this->certificatesTitle; }

    /** @param string $certificatesTitle */
    public function setCertificatesTitle($certificatesTitle) { $this->certificatesTitle = $certificatesTitle; }

    /** @return string */
    public function getNewsMenuName() { return $this->newsMenuName; }

    /** @param string $newsMenuName */
    public function setNewsMenuName($newsMenuName) { $this->newsMenuName = $newsMenuName; }

    /** @return string */
    public function getNewsTitle() { return $this->newsTitle; }

    /** @param string $newsTitle */
    public function setNewsTitle($newsTitle) { $this->newsTitle = $newsTitle; }

    /** @return string */
    public function getContactsMenuName() { return $this->contactsMenuName; }

    /** @param string $contactsMenuName */
    public function setContactsMenuName($contactsMenuName) { $this->contactsMenuName = $contactsMenuName; }

    /** @return string */
    public function getContactsTitle() { return $this->contactsTitle; }

    /** @param string $contactsTitle */
    public function setContactsTitle($contactsTitle) { $this->contactsTitle = $contactsTitle; }

}