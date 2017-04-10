<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с изображениями галерей статей
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ArticleGalleryImage extends PublicationGalleryImage {

    /**
     * @ORM\ManyToOne(targetEntity="app\models\ArticleGallery", inversedBy="images")
     * @ORM\JoinColumn(name="galleryId", referencedColumnName="id")
     */
    protected $gallery;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ArticleGalleryImageI18n", mappedBy="image")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /**
     * @inheritdoc
     * @return ArticleGalleryImageI18n[]
     */
    protected function getI18ns() {
        return $this->i18ns;
    }

    /**
     * @inheritdoc
     * @return ArticleGallery
     */
    public function getGallery() {
        return $this->gallery;
    }

    /**
     * @inheritdoc
     * @param ArticleGallery $gallery
     */
    public function setGallery(PublicationGallery $gallery) {
        $this->gallery = $gallery;
    }

}