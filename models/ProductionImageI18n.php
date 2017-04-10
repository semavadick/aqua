<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией изображений производства
 * @ORM\Entity()
 */
class ProductionImageI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\ProductionImage", inversedBy="i18ns")
     * @ORM\JoinColumn(name="imageId", referencedColumnName="id")
     */
    protected $productionImage;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $text = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return string */
    public function getText() { return $this->text; }

    /** @param string $text */
    public function setText($text) { $this->text = $text; }

    /** @return ProductionImage */
    public function getProductionImage() { return $this->productionImage; }

    /** @param ProductionImage $productionImage */
    public function setProductionImage($productionImage) { $this->productionImage = $productionImage; }


}