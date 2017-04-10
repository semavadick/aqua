<?php

namespace app\models;

use back\helpers\HandyFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией опции товара
 * @ORM\Entity()
 */
class AdditionProductOptionI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\AdditionProductOption", inversedBy="i18ns")
     * @ORM\JoinColumn(name="optionId", referencedColumnName="id")
     */
    protected $option;

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

    /** @return AdditionProductOption */
    public function getOption() { return $this->option; }

    /** @param AdditionProductOption $option */
    public function setOption($option) { $this->option = $option; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return string */
    public function getValue() { return $this->value; }

    /** @param string $value */
    public function setValue($value) { $this->value = $value; }

}