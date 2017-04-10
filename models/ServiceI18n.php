<?php

namespace app\models;

use back\helpers\HandyFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией услуги
 * @ORM\Entity()
 */
class ServiceI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Service", inversedBy="i18ns")
     * @ORM\JoinColumn(name="serviceId", referencedColumnName="id")
     */
    protected $service;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @ORM\Column(type="text") */
    protected $description = '';

    /** @ORM\Column(type="text") */
    protected $additDescription = '';

    /** @ORM\Column(type="text") */
    protected $video = '';

    /** @ORM\Column(type="string") */
    protected $slug = '';

    /** @ORM\Column(type="string") */
    protected $pageTitle = '';

    /** @ORM\Column(type="string") */
    protected $pageMetaKeywords = '';

    /** @ORM\Column(type="text") */
    protected $pageMetaDescription = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return Service */
    public function getService() { return $this->service; }

    /** @param Service $service */
    public function setService($service) { $this->service = $service; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

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

    /** @return string */
    public function getAdditDescription() { return $this->additDescription; }

    /** @param string $additDescription */
    public function setAdditDescription($additDescription) { $this->additDescription = $additDescription; }

    /** @return string */
    public function getVideo() { return $this->video; }

    /** @param string $video */
    public function setVideo($video) { $this->video = $video; }

}