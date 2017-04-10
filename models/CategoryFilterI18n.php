<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией фильтра категории
 * @ORM\Entity()
 */
class CategoryFilterI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\CategoryFilter", inversedBy="i18ns")
     * @ORM\JoinColumn(name="filterId", referencedColumnName="id")
     */
    protected $filter;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="text") */
    protected $text = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return string */
    public function getText() { return $this->text; }

    /** @param string $text */
    public function setText($text) { $this->text = $text; }

    /** @return CategoryFilter */
    public function getFilter() { return $this->filter; }

    /** @param CategoryFilter $filter */
    public function setFilter($filter) { $this->filter = $filter; }

}