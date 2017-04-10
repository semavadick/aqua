<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с преимуществом услуги
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceAdvantage extends Entity {

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
    protected $iconPath = '';

    /**
     * @ORM\ManyToOne(targetEntity="app\models\Service", inversedBy="advantages")
     * @ORM\JoinColumn(name="serviceId", referencedColumnName="id")
     */
    protected $service;

    const MAX_ICON_WIDTH = 100;
    const MAX_ICON_HEIGHT = 100;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ServiceAdvantageI18n", mappedBy="advantage")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return ServiceAdvantageI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getIconPath() { return $this->iconPath; }

    /** @return string */
    public function getIconUrl() { return $this->iconPath; }

    /** @param string $iconPath */
    public function setIconPath($iconPath) { $this->iconPath = $iconPath; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->iconPath);
    }

    /** @return Service */
    public function getService() { return $this->service; }

    /** @param Service $service */
    public function setService($service) { $this->service = $service; }

}