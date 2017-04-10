<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с принадлженостью
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Attachment extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $iconPath = '';

    CONST MAX_ICON_WIDTH = 100;
    CONST MAX_ICON_HEIGHT = 100;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AttachmentI18n", mappedBy="attachment")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return AttachmentI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->iconPath);
    }

    public function getText() {
        /** @var AttachmentI18n|null $i18n */
        $i18n = $this->getDefaultI18n();
        if(empty($i18n)) {
            return null;
        }
        return $i18n->getText();
    }

    /** @return string */
    public function getIconPath() { return $this->iconPath; }

    /** @param string $iconPath */
    public function setIconPath($iconPath) { $this->iconPath = $iconPath; }

}