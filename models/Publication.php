<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use back\helpers\MagicImage;
use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс для публикаций
 */
abstract class Publication extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;
    
    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime Added
     */
    protected $added;

    /** @ORM\Column(type="boolean") */
    protected $active = true;

    /** @ORM\Column(type="string") */
    protected $previewPath;

    /** @ORM\Column(type="string") */
    protected $bgPath;

    /** @ORM\Column(type="string") */
    protected $smallBgPath;

    const PREVIEW_WIDTH = 297;
    const PREVIEW_HEIGHT = 214;

    const BG_WIDTH = 2000;
    const BG_HEIGHT = 1400;

    const SMALL_BG_WIDTH = 1000;
    const SMALL_BG_HEIGHT = 700;

    /** @return int */
    public function getId() { return $this->id; }

    /** @return string */
    public function getAdded() { return $this->added->format('Y-m-d H:i'); }

    public function setAdded($added) {
        $this->added = new \DateTime($added);
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    /** @return string */
    public function getPreviewPath() { return $this->previewPath; }

    /** @param string $previewPath */
    public function setPreviewPath($previewPath) { $this->previewPath = $previewPath; }

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
        /** @var PublicationI18n|null $i18n */
        $i18n = $this->getI18n($ruLang);
        if(!empty($i18n)) {
            return $i18n->getName();
        }
        foreach($this->getI18ns() as $i18n) {
            return $i18n->getName();
        }
        return null;
    }

    /**
     * @return PublicationGallery[]
     */
    public abstract function getGalleries();

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->previewPath);
        MagicImage::deleteImage($this->bgPath);
        MagicImage::deleteImage($this->smallBgPath);
    }

    /** @return string */
    public function getFormattedDate() {
        return $this->added->format('d.m.Y');
    }

    /**
     * @return Category|null
     */
    public function getCategory() {
        return null;
    }

}