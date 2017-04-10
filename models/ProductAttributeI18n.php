<?php

namespace app\models;

use back\helpers\HandyFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией атрибута товара
 * @ORM\Entity()
 */
class ProductAttributeI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\ProductAttribute", inversedBy="i18ns")
     * @ORM\JoinColumn(name="attributeId", referencedColumnName="id")
     */
    protected $attribute;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="text") */
    protected $name = '';

    /** @ORM\Column(type="text") */
    protected $value = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return ProductAttribute */
    public function getAttribute() { return $this->attribute; }

    /** @param ProductAttribute $attribute */
    public function setAttribute($attribute) { $this->attribute = $attribute; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return string */
    public function getValue() { return $this->value; }

    /** @param string $value */
    public function setValue($value) { $this->value = $value; }

}