<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с изображением галереи объекта
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ObjectGalleryImage extends Entity {

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

    const BIG_WIDTH = 1600;
    const BIG_HEIGHT = 1104;

    const MEDIUM_WIDTH = 1000;
    const MEDIUM_HEIGHT = 690;

    const SMALL_WIDTH = 550;
    const SMALL_HEIGHT = 380;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\ObjectGallery", inversedBy="images")
     * @ORM\JoinColumn(name="galleryId", referencedColumnName="id")
     */
    protected $gallery;

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return array */
    public function getI18ns() { return []; }

    /** @param ObjectGallery $gallery */
    public function setGallery($gallery) { $this->gallery = $gallery; }

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

    public function getSort(){
        return $this->sort;
    }

    public function setSort($sort) {
        $this->sort = $sort;
    }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->smallPath);
        MagicImage::deleteImage($this->mediumPath);
        MagicImage::deleteImage($this->bigPath);
    }

    /** @return ObjectGallery */
    public function getGallery() { return $this->gallery; }

}