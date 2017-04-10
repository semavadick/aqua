<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с изображением производства
 * @ORM\Entity(repositoryClass="app\repositories\ProductionImagesRepository")
 */
class ProductionImage extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ProductionImageI18n", mappedBy="productionImage")
     */
    protected $i18ns;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /** @ORM\Column(type="string") */
    protected $imagePath = '';

    /** @ORM\Column(type="string") */
    protected $smallImagePath = '';

    /** @ORM\Column(type="string") */
    protected $mediumImagePath = '';

    const IMAGE_WIDTH = 1600;
    const IMAGE_HEIGHT = 1104;

    const MEDIUM_IMAGE_WIDTH = 1000;
    const MEDIUM_IMAGE_HEIGHT = 690;

    const SMALL_IMAGE_WIDTH = 550;
    const SMALL_IMAGE_HEIGHT = 380;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return string Путь до изображения */
    public function getImagePath() { return $this->imagePath; }

    /** @param string $imagePath Путь до изображения */
    public function setImagePath($imagePath) { $this->imagePath = $imagePath; }

    /** @return string Url изображения */
    public function getImageUrl() { return $this->imagePath; }

    /** @return int Сортировка */
    public function getSort() { return $this->sort; }

    /** @param int $sort Сортировка */
    public function setSort($sort) { $this->sort = $sort; }

    /** @return MainPageBannerI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getSmallImagePath() { return $this->smallImagePath; }

    /** @param string $smallImagePath */
    public function setSmallImagePath($smallImagePath) { $this->smallImagePath = $smallImagePath; }

    /** @return string */
    public function getMediumImagePath() { return $this->mediumImagePath; }

    /** @return string */
    public function getMediumImageUrl() { return $this->mediumImagePath; }

    /** @param string $mediumImagePath */
    public function setMediumImagePath($mediumImagePath) { $this->mediumImagePath = $mediumImagePath; }

}