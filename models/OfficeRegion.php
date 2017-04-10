<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с регионом офиса
 * @ORM\Entity(repositoryClass="app\repositories\OfficeRegionsRepository")
 */
class OfficeRegion extends Entity {

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
     * @ORM\OneToMany(targetEntity="app\models\OfficeRegionI18n", mappedBy="region")
     */
    protected $i18ns;

    /**
     * @ORM\OneToMany(targetEntity="app\models\Office", mappedBy="region")
     */
    protected $offices;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
        $this->offices = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return OfficeRegionI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return int */
    public function getSort() { return $this->sort; }

    /** @param int $sort */
    public function setSort($sort) { $this->sort = $sort; }

    /**
     * @return string|null
     */
    public function getName() {
        $ruLang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        /** @var OfficeRegionI18n|null $i18n */
        $i18n = $this->getI18n($ruLang);
        if(!empty($i18n)) {
            return $i18n->getName();
        }
        foreach($this->getI18ns() as $i18n) {
            return $i18n->getName();
        }
        return null;
    }

    /** @return Office[] */
    public function getOffices() { return $this->offices; }

    /** @param Office[] $offices */
    public function setOffices($offices) { $this->offices = $offices; }

}