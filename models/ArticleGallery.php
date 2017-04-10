<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с галереями статей
 * @ORM\Entity()
 */
class ArticleGallery extends PublicationGallery {

    /**
     * @ORM\ManyToOne(targetEntity="app\models\Article", inversedBy="galleries")
     * @ORM\JoinColumn(name="articleId", referencedColumnName="id")
     */
    protected $article;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ArticleGalleryImage", mappedBy="gallery")
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
     * @return Article
     */
    public function getPublication() {
        return $this->article;
    }

    /**
     * @inheritdoc
     * @param Article $publication
     */
    public function setPublication(Publication $publication) {
        $this->article = $publication;
    }

    /** @return ArticleGalleryImage[] */
    public function getImages() { return $this->images; }
}