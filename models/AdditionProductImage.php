<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с атрибутом товара
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AdditionProductImage extends Entity {

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

    const SMALL_WIDTH = 100;
    const SMALL_HEIGHT = 62;

    const MEDIUM_WIDTH = 798;
    const MEDIUM_HEIGHT = 502;

    const BIG_WIDTH = 1000;
    const BIG_HEIGHT = 1000;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\AdditionProduct", inversedBy="images")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    protected $product;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionProductImageI18n", mappedBy="attribute")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return AdditionProductImageI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return AdditionProduct */
    public function getProduct() { return $this->product; }

    /** @param AdditionProduct $product */
    public function setProduct($product) { $this->product = $product; }

    public function getSort(){
        return $this->sort;
    }

    public function setSort($sort){
        $this->sort = $sort;
    }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->smallPath);
        MagicImage::deleteImage($this->mediumPath);
        MagicImage::deleteImage($this->bigPath);
    }

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


}