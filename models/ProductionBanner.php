<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с баннером производста
 * @ORM\Entity(repositoryClass="app\repositories\ProductionBannersRepository")
 */
class ProductionBanner extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ProductionBannerI18n", mappedBy="banner")
     */
    protected $i18ns;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /** @ORM\Column(type="string") */
    protected $imagePath = '';

    const IMAGE_WIDTH = 190;
    const IMAGE_HEIGHT = 170;

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

}