<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с галереей объекта
 * @ORM\Entity(repositoryClass="app\repositories\ObjectGalleriesRepository")
 */
class ObjectGallery extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /** @ORM\Column(type="boolean") */
    protected $isTop = false;

    /** @ORM\Column(type="boolean") */
    protected $isExclusive = false;

    /** @ORM\Column(type="float") */
    protected $coordsLat = 0;

    /** @ORM\Column(type="float") */
    protected $coordsLng = 0;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ObjectGalleryI18n", mappedBy="gallery")
     */
    protected $i18ns;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ObjectGalleryImage", mappedBy="gallery")
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    protected $images;

    /**
     * @ORM\ManyToMany(targetEntity="app\models\PoolType", inversedBy="objectGalleries")
     * @ORM\JoinTable(
     *  name="ObjectGalleryType",
     *  joinColumns={
     *      @ORM\JoinColumn(name="galleryId", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="typeId", referencedColumnName="id")
     *  }
     * )
     */
    protected $poolTypes;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->poolTypes = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return ObjectGalleryI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return ObjectGalleryImage[] */
    public function getImages() { return $this->images; }

    public function getImagesCount() {
        return count($this->images);
    }

    /** @return ObjectGalleryImage|null */
    public function getPreviewImage() {
        // TODO checkbox
        return !empty($this->images) ? $this->images[0] : null;
    }

    public function getName() {
        /** @var ObjectGalleryI18n|null $i18n */
        $i18n = $this->getDefaultI18n();
        return !empty($i18n) ? $i18n->getName() : null;
    }

    /** @return boolean */
    public function getIsTop() { return $this->isTop; }

    /** @param boolean $isTop */
    public function setIsTop($isTop) { $this->isTop = $isTop; }

    /** @return boolean */
    public function getIsExclusive() { return $this->isExclusive; }

    /** @param boolean $isExclusive */
    public function setIsExclusive($isExclusive) { $this->isExclusive = $isExclusive; }

    /** @return float */
    public function getCoordsLat() { return $this->coordsLat; }

    /** @param float $coordsLat */
    public function setCoordsLat($coordsLat) { $this->coordsLat = $coordsLat; }

    /** @return float */
    public function getCoordsLng() { return $this->coordsLng; }

    /** @param float $coordsLng */
    public function setCoordsLng($coordsLng) { $this->coordsLng = $coordsLng; }

    /** @return PoolType[] */
    public function getPoolTypes() {
        return $this->poolTypes;
    }

    /** @param PoolType[] $types */
    public function setPoolTypes($types) {
        /** @var PoolType[] $typesToDelete */
        $typesToDelete = [];
        foreach($this->getPoolTypes() as $type) {
            $typesToDelete[$type->getId()] = $type;
        }

        foreach($types as $type) {
            if(isset($typesToDelete[$type->getId()])) {
                unset($typesToDelete[$type->getId()]);
            }
            if($this->poolTypes->contains($type)) {
                continue;
            }
            $this->poolTypes->add($type);
        }

        foreach($typesToDelete as $type) {
            $this->poolTypes->removeElement($type);
        }
    }

}