<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с галереями новостей
 * @ORM\Entity()
 */
class NewsGallery extends PublicationGallery {

    /**
     * @ORM\ManyToOne(targetEntity="app\models\News", inversedBy="galleries")
     * @ORM\JoinColumn(name="newsId", referencedColumnName="id")
     */
    protected $newsItem;

    /**
     * @ORM\OneToMany(targetEntity="app\models\NewsGalleryImage", mappedBy="gallery")
     * @ORM\OrderBy({"sort" = "ASC"})
     */

    protected $images = [];

    public function __construct() {
        $this->images = new ArrayCollection();
    }

    /** @return I18n[] */
    protected function getI18ns() {
        return [];
    }

    /**
     * @inheritdoc
     * @return News
     */
    public function getPublication() {
        return $this->newsItem;
    }

    /**
     * @inheritdoc
     * @param News $publication
     */
    public function setPublication(Publication $publication) {
        $this->newsItem = $publication;
    }

    /** @return NewsGalleryImage[] */
    public function getImages() { return $this->images; }
}