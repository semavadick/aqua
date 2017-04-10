<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с преимуществом технологии
 * @ORM\Entity(repositoryClass="app\repositories\TechAdvantagesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TechAdvantage extends Entity {

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

    const MAX_ICON_WIDTH = 100;
    const MAX_ICON_HEIGHT = 100;

    /**
     * @ORM\OneToMany(targetEntity="app\models\TechAdvantageI18n", mappedBy="advantage")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return TechAdvantageI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getIconPath() { return $this->iconPath; }

    /** @return string */
    public function getIconUrl() { return $this->iconPath; }

    /** @param string $iconPath */
    public function setIconPath($iconPath) { $this->iconPath = $iconPath; }

    public function getTagline() {
        $ruLang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        /** @var TechAdvantageI18n|null $i18n */
        $i18n = $this->getI18n($ruLang);
        if(!empty($i18n)) {
            return $i18n->getTagline();
        }
        foreach($this->getI18ns() as $i18n) {
            return $i18n->getTagline();
        }
        return null;
    }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->iconPath);
    }

}