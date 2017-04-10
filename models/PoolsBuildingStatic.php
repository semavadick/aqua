<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с статическими страницами Строительства бассейнов
 * @ORM\Entity(repositoryClass="app\repositories\PoolsBuildingStaticRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PoolsBuildingStatic extends Entity {

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
    const BG_HEIGHT = 1079;

    const SMALL_BG_WIDTH = 810;
    const SMALL_BG_HEIGHT = 270;

    CONST REBUILDING_ID = 1;

    /**
     * @ORM\OneToMany(targetEntity="app\models\PoolsBuildingStaticI18n", mappedBy="poolsBuildingStatic")
     */
    protected $i18ns;

    /**
     * @ORM\OneToMany(targetEntity="app\models\PoolsBuildingStaticGallery", mappedBy="poolsBuildingStatic")
     */
    protected $galleries = [];


    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return PoolsBuildingStaticI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getBgPath() { return $this->bgPath; }

    /** @param string $bgPath */
    public function setBgPath($bgPath) { $this->bgPath = $bgPath; }

    /** @return string */
    public function getSmallBgPath() { return $this->smallBgPath; }

    /** @param string $smallBgPath */
    public function setSmallBgPath($smallBgPath) { $this->smallBgPath = $smallBgPath; }

    /** @return string|null */
    public function getName() {
        $ruLang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        /** @var PoolsBuildingStaticI18n|null $i18n */
        $i18n = $this->getI18n($ruLang);
        if(!empty($i18n)) {
            return $i18n->getName();
        }
        foreach($this->getI18ns() as $i18n) {
            return $i18n->getName();
        }
        return null;
    }


    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->bgPath);
        MagicImage::deleteImage($this->smallBgPath);
    }

    /** @return PoolsBuildingStaticGallery[] */
    public function getGalleries() { return $this->galleries->toArray(); }
}