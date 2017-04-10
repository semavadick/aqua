<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс для изображения галлереи публикаций
 */
abstract class PublicationGalleryImageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /**
     * @return PublicationGalleryImage
     */
    public abstract function getImage();

    /**
     * @param PublicationGalleryImage $image
     */
    public abstract function setImage(PublicationGalleryImage $image);

}