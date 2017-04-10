<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с преимуществом
 * @ORM\Entity(repositoryClass="app\repositories\AdvantagesRepository")
 */
class Advantage extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $iconPath = '';

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdvantageI18n", mappedBy="advantage")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return MainPageBannerI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getIconPath() { return $this->iconPath; }

    /** @return string */
    public function getIconUrl() { return $this->iconPath; }

    /** @param string $iconPath */
    public function setIconPath($iconPath) { $this->iconPath = $iconPath; }

    /** @return string|null */
    public function getText() {
        $ruLang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        /** @var AdvantageI18n|null $i18n */
        $i18n = $this->getI18n($ruLang);
        if(!empty($i18n)) {
            return $i18n->getText();
        }
        foreach($this->getI18ns() as $i18n) {
            return $i18n->getText();
        }
        return null;
    }

}