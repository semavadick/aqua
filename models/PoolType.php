<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с типами бассейнов
 * @ORM\Entity(repositoryClass="app\repositories\PoolTypesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PoolType extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /** @ORM\Column(type="string") */
    protected $previewPath = '';

    /** @ORM\Column(type="string") */
    protected $widePreviewPath = '';

    /** @ORM\Column(type="string") */
    protected $bgPath = '';

    /** @ORM\Column(type="string") */
    protected $smallBgPath = '';

    const BG_WIDTH = 1620;
    const BG_HEIGHT = 1079;

    const SMALL_BG_WIDTH = 810;
    const SMALL_BG_HEIGHT = 540;

    const PREVIEW_WIDTH = 440;
    const PREVIEW_HEIGHT = 234;

    const WIDE_PREVIEW_WIDTH = 660;
    const WIDE_PREVIEW_HEIGHT = 241;

    /**
     * @ORM\OneToMany(targetEntity="app\models\PoolTypeI18n", mappedBy="type")
     */
    protected $i18ns;

    /**
     * @ORM\OneToMany(targetEntity="app\models\TypeAdvantage", mappedBy="type")
     */
    protected $advantages = [];

    /**
     * @ORM\ManyToMany(targetEntity="app\models\ObjectGallery", mappedBy="poolTypes")
     */
    protected $objectGalleries;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
        $this->advantages = new ArrayCollection();
        $this->objectGalleries = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return MainPageBannerI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getPreviewPath() { return $this->previewPath; }

    /** @param string $previewPath */
    public function setPreviewPath($previewPath) { $this->previewPath = $previewPath; }

    /** @return string */
    public function getWidePreviewPath() { return $this->widePreviewPath; }

    /** @param string $widePreviewPath */
    public function setWidePreviewPath($widePreviewPath) { $this->widePreviewPath = $widePreviewPath; }

    /** @return string */
    public function getBgPath() { return $this->bgPath; }

    /** @param string $bgPath */
    public function setBgPath($bgPath) { $this->bgPath = $bgPath; }

    /** @return string */
    public function getSmallBgPath() { return $this->smallBgPath; }

    /** @param string $smallBgPath */
    public function setSmallBgPath($smallBgPath) { $this->smallBgPath = $smallBgPath; }

    /** @return TypeAdvantage[] */
    public function getAdvantages() { return $this->advantages; }

    /** @param TypeAdvantage[] $advantages */
    public function setAdvantages($advantages) { $this->advantages = $advantages; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->previewPath);
        MagicImage::deleteImage($this->widePreviewPath);
        MagicImage::deleteImage($this->bgPath);
        MagicImage::deleteImage($this->smallBgPath);
    }

    public function getName() {
        /** @var PoolTypeI18n|null $i18n */
        $i18n = $this->getDefaultI18n();
        if(empty($i18n)) {
            return null;
        }
        return $i18n->getName();
    }

    public function getPreviewUrlForGrid() {
        return !empty($this->previewPath) ? $this->previewPath : $this->widePreviewPath;
    }

    /** @return ObjectGallery[] */
    public function getObjectGalleries() { return $this->objectGalleries; }

}