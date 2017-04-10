<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией изображений новостей
 * @ORM\Entity()
 */
class NewsGalleryImageI18n extends PublicationGalleryImageI18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\NewsGalleryImage", inversedBy="i18ns")
     * @ORM\JoinColumn(name="imageId", referencedColumnName="id")
     */
    protected $image;

    /**
     * @inheritdoc
     * @return NewsGalleryImage
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @inheritdoc
     * @param NewsGalleryImage $image
     */
    public function setImage(PublicationGalleryImage $image) {
        $this->image = $image;
    }
}