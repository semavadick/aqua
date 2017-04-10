<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс для изображения галлереи статических страниц Строительства бассейнов
 * @ORM\Entity()
 */
class PoolsBuildingStaticGalleryImageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $name = '';

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\PoolsBuildingStaticGalleryImage", inversedBy="i18ns")
     * @ORM\JoinColumn(name="imageId", referencedColumnName="id")
     */
    protected $image;

    /**
     * @inheritdoc
     * @return PoolsBuildingStaticGalleryImage
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @inheritdoc
     * @param NewsGalleryImage $image
     */
    public function setImage(PoolsBuildingStaticGalleryImage $image) {
        $this->image = $image;
    }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }
}