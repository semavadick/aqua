<?php

namespace app\models;

use app\components\Doctrine;
use app\helpers\SlugHelper;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией товара
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ProductI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Product", inversedBy="i18ns")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    protected $product;

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

    /** @return Product */
    public function getProduct() { return $this->product; }

    /** @param Product $product */
    public function setProduct($product) { $this->product = $product; }

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

    /** @ORM\PreFlush() */
    public function generateSlug() {
        if(!empty($this->slug)) {
            return;
        }
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        $this->slug = (new SlugHelper())->generateUniqueSlugForI18n($this, $this->name, $doctrine->getEntityManager()->getRepository('Models:ProductI18n'));
    }

}