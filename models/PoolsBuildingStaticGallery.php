<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс для галлереи статических страниц Строительства бассейнов
 * @ORM\Entity()
 */

class PoolsBuildingStaticGallery extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\PoolsBuildingStatic", inversedBy="galleries")
     * @ORM\JoinColumn(name="poolsBuildingStaticId", referencedColumnName="id")
     */
    protected $poolsBuildingStatic;

    /**
     * @ORM\OneToMany(targetEntity="app\models\PoolsBuildingStaticGalleryImage", mappedBy="gallery")
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    protected $images = [];

    public function __construct() {
        $this->images = new ArrayCollection();
    }

    /** @return I18n[] */
    protected function getI18ns() {
        return [];
    }

    /** @return int */
    public function getId() { return $this->id; }

    /** @return integer */
    public function getSort() { return $this->sort; }

    /** @param integer $sort */
    public function setSort($sort) { $this->sort = $sort; }

    /** @return PoolsBuildingStaticGalleryImage[] */
    public function getImages() { return $this->images; }

    public function getPoolsBuildingStatic(){
        return $this->poolsBuildingStatic;
    }

    public function setPoolsBuildingStatic(PoolsBuildingStatic $poolsBuildingStatic) {
        $this->poolsBuildingStatic = $poolsBuildingStatic;
    }

}