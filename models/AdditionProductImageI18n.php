<?php

namespace app\models;

use back\helpers\HandyFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией изображения товара
 * @ORM\Entity()
 */
class AdditionProductImageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\AdditionProductImage", inversedBy="i18ns")
     * @ORM\JoinColumn(name="imageId", referencedColumnName="id")
     */
    protected $image;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="text") */
    protected $name = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return AdditionProductImage */
    public function getImage() { return $this->image; }

    /** @param AdditionProductImage $image */
    public function setImage($image) { $this->image = $image; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

}