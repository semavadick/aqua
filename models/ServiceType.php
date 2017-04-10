<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с типом изделий услуги
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceType extends Entity {

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
    protected $imagePath = '';

    /**
     * @ORM\ManyToOne(targetEntity="app\models\Service", inversedBy="types")
     * @ORM\JoinColumn(name="serviceId", referencedColumnName="id")
     */
    protected $service;

    const MAX_ICON_WIDTH = 200;
    const MAX_ICON_HEIGHT = 153;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ServiceTypeI18n", mappedBy="type")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return ServiceTypeI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getImagePath() { return $this->imagePath; }

    /** @return string */
    public function getImageUrl() { return $this->imagePath; }

    /** @param string $imagePath */
    public function setImagePath($imagePath) { $this->imagePath = $imagePath; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->imagePath);
    }

    /** @return Service */
    public function getService() { return $this->service; }

    /** @param Service $service */
    public function setService($service) { $this->service = $service; }

}