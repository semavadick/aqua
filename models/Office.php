<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с офисом
 * @ORM\Entity()
 */
class Office extends Entity {

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
     * @ORM\ManyToOne(targetEntity="app\models\OfficeRegion", inversedBy="offices")
     * @ORM\JoinColumn(name="regionId", referencedColumnName="id")
     */
    protected $region;

    /** @ORM\Column(type="float") */
    protected $coordsLat = 0;

    /** @ORM\Column(type="float") */
    protected $coordsLng = 0;

    /** @ORM\Column(type="string") */
    protected $phone = '';

    /**
     * @ORM\OneToMany(targetEntity="app\models\OfficeI18n", mappedBy="office")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return OfficeI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return int */
    public function getSort() { return $this->sort; }

    /** @param int $sort */
    public function setSort($sort) { $this->sort = $sort; }

    /** @return OfficeRegion */
    public function getRegion() { return $this->region; }

    /** @param OfficeRegion $region */
    public function setRegion($region) { $this->region = $region; }

    /** @return float */
    public function getCoordsLat() { return $this->coordsLat; }

    /** @param float $coordsLat */
    public function setCoordsLat($coordsLat) { $this->coordsLat = $coordsLat; }

    /** @return float */
    public function getCoordsLng() { return $this->coordsLng; }

    /** @param float $coordsLng */
    public function setCoordsLng($coordsLng) { $this->coordsLng = $coordsLng; }

    /** @return string */
    public function getPhone() { return $this->phone; }

    /** @param string $phone */
    public function setPhone($phone) { $this->phone = $phone; }

    /** @return string|null */
    public function getAddress() {
        $ruLang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        /** @var OfficeI18n|null $i18n */
        $i18n = $this->getI18n($ruLang);
        if(!empty($i18n)) {
            return $i18n->getAddress();
        }
        foreach($this->getI18ns() as $i18n) {
            return $i18n->getAddress();
        }
        return null;
    }

}