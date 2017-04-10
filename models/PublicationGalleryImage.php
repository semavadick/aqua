<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс для изображения галлереи публикаций
 */
abstract class PublicationGalleryImage extends Entity {

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
    const BIG_HEIGHT = 1090;

    const MEDIUM_WIDTH = 818;
    const MEDIUM_HEIGHT = 545;

    const SMALL_WIDTH = 409;
    const SMALL_HEIGHT = 273;

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

    /**
     * @return PublicationGallery
     */
    public abstract function getGallery();

    /**
     * @param PublicationGallery $gallery
     */
    public abstract function setGallery(PublicationGallery $gallery);

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->bigPath);
        MagicImage::deleteImage($this->mediumPath);
        MagicImage::deleteImage($this->smallPath);
    }

}