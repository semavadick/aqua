<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с преимуществом типа бассейна
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class TypeAdvantage extends Entity {

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
     * @ORM\ManyToOne(targetEntity="app\models\PoolType", inversedBy="advantages")
     * @ORM\JoinColumn(name="typeId", referencedColumnName="id")
     */
    protected $type;

    const MAX_ICON_WIDTH = 100;
    const MAX_ICON_HEIGHT = 100;

    /**
     * @ORM\OneToMany(targetEntity="app\models\TypeAdvantageI18n", mappedBy="advantage")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return TypeAdvantageI18n[] */
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

    /** @return PoolType */
    public function getType() { return $this->type; }

    /** @param PoolType $type */
    public function setType($type) { $this->type = $type; }

}