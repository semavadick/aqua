<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с услугами
 * @ORM\Entity(repositoryClass="app\repositories\ServicesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Service extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $bgPath = '';

    /** @ORM\Column(type="string") */
    protected $smallBgPath = '';

    const BG_WIDTH = 1620;
    const BG_HEIGHT = 540;

    const SMALL_BG_WIDTH = 810;
    const SMALL_BG_HEIGHT = 270;

    CONST MAINTENANCE_ID = 1;
    CONST EXCLUSIVE_ID = 2;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ServiceI18n", mappedBy="service")
     */
    protected $i18ns;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ServiceAdvantage", mappedBy="service")
     */
    protected $advantages = [];

    /**
     * @ORM\OneToMany(targetEntity="app\models\ServiceType", mappedBy="service")
     */
    protected $types = [];

    public function __construct() {
        $this->i18ns = new ArrayCollection();
        $this->advantages = new ArrayCollection();
        $this->types = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return ServiceI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getBgPath() { return $this->bgPath; }

    /** @param string $bgPath */
    public function setBgPath($bgPath) { $this->bgPath = $bgPath; }

    /** @return string */
    public function getSmallBgPath() { return $this->smallBgPath; }

    /** @param string $smallBgPath */
    public function setSmallBgPath($smallBgPath) { $this->smallBgPath = $smallBgPath; }

    /** @return ServiceAdvantage[] */
    public function getAdvantages() { return $this->advantages; }

    /** @param ServiceAdvantage[] $advantages */
    public function setAdvantages($advantages) { $this->advantages = $advantages; }

    /** @return ServiceType[] */
    public function getTypes() { return $this->types; }

    /** @param ServiceType[] $types */
    public function setTypes($types) { $this->types = $types; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->bgPath);
        MagicImage::deleteImage($this->smallBgPath);
    }

}