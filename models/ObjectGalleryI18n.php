<?php

namespace app\models;

use app\components\Doctrine;
use app\helpers\SlugHelper;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией галереи объекта
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ObjectGalleryI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\ObjectGallery", inversedBy="i18ns")
     * @ORM\JoinColumn(name="galleryId", referencedColumnName="id")
     */
    protected $gallery;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $address = '';

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @ORM\Column(type="text") */
    protected $shortDescription = '';

    /** @ORM\Column(type="text") */
    protected $description = '';

    /** @ORM\Column(type="string") */
    protected $slug = '';

    /** @ORM\Column(type="string") */
    protected $pageTitle = '';

    /** @ORM\Column(type="string") */
    protected $pageMetaKeywords = '';

    /** @ORM\Column(type="string") */
    protected $pageMetaDescription = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return ObjectGallery */
    public function getGallery() { return $this->gallery; }

    /** @param ObjectGallery $advantage */
    public function setGallery($advantage) { $this->gallery = $advantage; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return string */
    public function getShortDescription() { return $this->shortDescription; }

    /** @param string $shortDescription */
    public function setShortDescription($shortDescription) { $this->shortDescription = $shortDescription; }

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
    public function getAddress() { return $this->address; }

    /** @param string $address */
    public function setAddress($address) { $this->address = $address; }

    /** @ORM\PreFlush() */
    public function generateSlug() {
        if(!empty($this->slug)) {
            return;
        }
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        $this->slug = (new SlugHelper())->generateUniqueSlugForI18n($this, $this->name, $doctrine->getEntityManager()->getRepository('Models:ObjectGalleryI18n'));
    }

}