<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией публикации
 */
abstract class PublicationI18n extends I18n {
    
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @ORM\Column(type="text") */
    protected $shortDescription = '';

    /** @ORM\Column(type="text") */
    protected $description = '';

    /** @ORM\Column(type="string") */
    protected $slug = '';

    /** @ORM\Column(type="string") */
    protected $pageTitle = '';

    /** @ORM\Column(type="string") */
    protected $pageMetaKeywords = '';

    /** @ORM\Column(type="string") */
    protected $pageMetaDescription = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }
    
    /** @return string */
    public function getShortDescription() { return $this->shortDescription; }

    /** @param string $shortDescription */
    public function setShortDescription($shortDescription) { $this->shortDescription = $shortDescription; }

    /** @return string */
    public function getDescription() { return $this->description; }

    /** @param string $description */
    public function setDescription($description) { $this->description = $description; }

    /** @return string */
    public function getSlug() { return $this->slug; }

    /** @param string $slug */
    public function setSlug($slug) { $this->slug = $slug; }

    /** @return string */
    public function getPageTitle() { return $this->pageTitle; }

    /** @param string $pageTitle */
    public function setPageTitle($pageTitle) { $this->pageTitle = $pageTitle; }

    /** @return string */
    public function getPageMetaKeywords() { return $this->pageMetaKeywords; }

    /** @param string $pageMetaKeywords */
    public function setPageMetaKeywords($pageMetaKeywords) { $this->pageMetaKeywords = $pageMetaKeywords; }

    /** @return string */
    public function getPageMetaDescription() { return $this->pageMetaDescription; }

    /** @param string $pageMetaDescription */
    public function setPageMetaDescription($pageMetaDescription) { $this->pageMetaDescription = $pageMetaDescription; }

    /**
     * @return Publication
     */
    public abstract function getPublication();

    /**
     * @param Publication $publication
     */
    public abstract function setPublication(Publication $publication);

}