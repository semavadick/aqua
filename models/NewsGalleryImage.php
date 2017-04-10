<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с изображениями галерей новостей
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class NewsGalleryImage extends PublicationGalleryImage {

    /**
     * @ORM\ManyToOne(targetEntity="app\models\NewsGallery", inversedBy="images")
     * @ORM\JoinColumn(name="galleryId", referencedColumnName="id")
     */
    protected $gallery;

    /**
     * @ORM\OneToMany(targetEntity="app\models\NewsGalleryImageI18n", mappedBy="image")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /**
     * @inheritdoc
     * @return NewsGalleryImageI18n[]
     */
    protected function getI18ns() {
        return $this->i18ns;
    }

    /**
     * @inheritdoc
     * @return NewsGallery
     */
    public function getGallery() {
        return $this->gallery;
    }

    /**
     * @inheritdoc
     * @param NewsGallery $gallery
     */
    public function setGallery(PublicationGallery $gallery) {
        $this->gallery = $gallery;
    }

}