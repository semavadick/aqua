<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы со слайдом главной страницы
 * @ORM\Entity(repositoryClass="app\repositories\MainPageSlidesRepository")
 */
class MainPageSlide extends Entity{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="app\models\MainPageSlideI18n", mappedBy="slide")
     */
    protected $i18ns;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /** @ORM\Column(type="string") */
    protected $imagePath = '';

    /** @ORM\Column(type="string") */
    protected $smallImagePath = '';

    const IMAGE_WIDTH = 2000;
    const IMAGE_HEIGHT = 1400;

    const SMALLIMAGE_WIDTH = 1000;
    const SMALL_IMAGE_HEIGHT = 700;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return string Путь до изображения */
    public function getImagePath() { return $this->imagePath; }

    /** @param string $imagePath Путь до изображения */
    public function setImagePath($imagePath) { $this->imagePath = $imagePath; }

    /** @return string Url изображения */
    public function getImageUrl() { return $this->imagePath; }

    /** @return string Путь до маленького изображения */
    public function getSmallImagePath() { return $this->smallImagePath; }

    /** @return string Url маленького изображения */
    public function getSmallImageUrl() { return $this->smallImagePath; }

    /** @param string $smallImagePath Путь до маленького изображения */
    public function setSmallImagePath($smallImagePath) { $this->smallImagePath = $smallImagePath; }

    /** @return int Сортировка */
    public function getSort() { return $this->sort; }

    /** @param int $sort Сортировка */
    public function setSort($sort) { $this->sort = $sort; }

    /** @return MainPageSlideI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @inheritdoc */
    public function getI18n(Language $language) {
        foreach($this->getI18ns() as $i18n) {
            if($i18n->getLanguage()->getId() == $language->getId()) {
                return $i18n;
            }
        }
        return null;
    }

}