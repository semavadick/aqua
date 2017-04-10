<?php

namespace app\models;

use back\helpers\HandyFile;
use back\helpers\MagicImage;
use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией страницы Каталог
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class CatalogPageI18n extends I18n {

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

    /** @ORM\Column(type="text") */
    protected $deliveryDescription = '';

    /** @ORM\Column(type="string") */
    protected $catalogImagePath = '';

    /** @ORM\Column(type="string") */
    protected $catalogFilePath = '';

    const CATALOG_IMAGE_WIDTH = 172;
    const CATALOG_IMAGE_HEIGHT = 237;

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
    public function getCatalogImagePath() { return $this->catalogImagePath; }

    /** @param string $catalogImagePath */
    public function setCatalogImagePath($catalogImagePath) { $this->catalogImagePath = $catalogImagePath; }

    /** @return string */
    public function getCatalogFilePath() { return $this->catalogFilePath; }

    /** @param string $catalogFilePath */
    public function setCatalogFilePath($catalogFilePath) { $this->catalogFilePath = $catalogFilePath; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->catalogImagePath);
        HandyFile::deleteFile($this->catalogFilePath);
    }

    /** @return string */
    public function getDeliveryDescription() { return $this->deliveryDescription; }

    /** @param string $deliveryDescription */
    public function setDeliveryDescription($deliveryDescription) { $this->deliveryDescription = $deliveryDescription; }

}