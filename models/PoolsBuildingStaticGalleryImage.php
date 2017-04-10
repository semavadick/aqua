<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс для изображения галлереи статических страниц Строительства бассейнов
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class PoolsBuildingStaticGalleryImage extends Entity {

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
    protected $smallPath = '';

    /** @ORM\Column(type="string") */
    protected $mediumPath = '';

    /** @ORM\Column(type="string") */
    protected $bigPath = '';

    const BIG_WIDTH = 1636;
    const BIG_HEIGHT = 700;

    const MEDIUM_WIDTH = 1100;
    const MEDIUM_HEIGHT = 545;

    const SMALL_WIDTH = 409;
    const SMALL_HEIGHT = 273;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\PoolsBuildingStaticGallery", inversedBy="images")
     * @ORM\JoinColumn(name="galleryId", referencedColumnName="id")
     */
    protected $gallery;

    /**
     * @ORM\OneToMany(targetEntity="app\models\PoolsBuildingStaticGalleryImageI18n", mappedBy="image")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /**
     * @inheritdoc
     * @return PoolsBuildingStaticGalleryImageI18n[]
     */
    protected function getI18ns() {
        return $this->i18ns;
    }

    /**
     * @inheritdoc
     * @return PoolsBuildingStaticGallery
     */
    public function getGallery() {
        return $this->gallery;
    }

    /**
     * @inheritdoc
     * @param PoolsBuildingStaticGallery $gallery
     */
    public function setGallery(PoolsBuildingStaticGallery $gallery) {
        $this->gallery = $gallery;
    }

    /** @return int */
    public function getId() { return $this->id; }

    /** @return integer */
    public function getSort() { return $this->sort; }

    /** @param integer $sort */
    public function setSort($sort) { $this->sort = $sort; }

    /** @return string */
    public function getSmallPath() { return $this->smallPath; }

    /** @param string $smallPath */
    public function setSmallPath($smallPath) { $this->smallPath = $smallPath; }

    /** @return string */
    public function getMediumPath() { return $this->mediumPath; }

    /** @param string $mediumPath */
    public function setMediumPath($mediumPath) { $this->mediumPath = $mediumPath; }

    /** @return string */
    public function getBigPath() { return $this->bigPath; }

    /** @param string $bigPath */
    public function setBigPath($bigPath) { $this->bigPath = $bigPath; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->bigPath);
        MagicImage::deleteImage($this->mediumPath);
        MagicImage::deleteImage($this->smallPath);
    }
}