<?php

namespace app\models;

use app\components\Doctrine;
use app\helpers\SlugHelper;
use app\helpers\TransliterationHelper;
use app\repositories\PoolTypesRepository;
use back\helpers\HandyFile;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией типа бассейна
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class PoolTypeI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\PoolType", inversedBy="i18ns")
     * @ORM\JoinColumn(name="typeId", referencedColumnName="id")
     */
    protected $type;

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
    protected $stagesPath = '';

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

    /** @return PoolType */
    public function getType() { return $this->type; }

    /** @param PoolType $type */
    public function setType($type) { $this->type = $type; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return string */
    public function getDescription() { return $this->description; }

    /** @param string $description */
    public function setDescription($description) { $this->description = $description; }

    /** @return string */
    public function getStagesPath() { return $this->stagesPath; }

    /** @param string $stagesPath */
    public function setStagesPath($stagesPath) { $this->stagesPath = $stagesPath; }

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

    /** @ORM\PostRemove() */
    public function removeAssets() {
        HandyFile::deleteFile($this->stagesPath);
    }

    /** @ORM\PreFlush() */
    public function generateSlug() {
        if(!empty($this->slug)) {
            return;
        }
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        $this->slug = (new SlugHelper())->generateUniqueSlugForI18n($this, $this->name, $doctrine->getEntityManager()->getRepository('Models:PoolTypeI18n'));
    }
    
}