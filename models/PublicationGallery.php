<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс для галлереи публикаций
 */
abstract class PublicationGallery extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;
    
    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /** @return int */
    public function getId() { return $this->id; }

    /** @return integer */
    public function getSort() { return $this->sort; }

    /** @param integer $sort */
    public function setSort($sort) { $this->sort = $sort; }

    /**
     * @return Publication
     */
    public abstract function getPublication();

    /**
     * @param Publication $publication
     */
    public abstract function setPublication(Publication $publication);

    /** @return PublicationGalleryImage[] */
    public abstract function getImages();

}