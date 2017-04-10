<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;
use app\models\Language;

/**
 * Класс для работы с локализацией изображений статей
 * @ORM\Entity()
 */
class ArticleGalleryImageI18n extends PublicationGalleryImageI18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\ArticleGalleryImage", inversedBy="i18ns")
     * @ORM\JoinColumn(name="imageId", referencedColumnName="id")
     */
    protected $image;

    /**
     * @inheritdoc
     * @return ArticleGalleryImage
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @inheritdoc
     * @param ArticleGalleryImage $image
     */
    public function setImage(PublicationGalleryImage $image) {
        $this->image = $image;
    }
}