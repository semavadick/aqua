<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с новостями
 * @ORM\Entity(repositoryClass="app\repositories\NewsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class News extends Publication {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="app\models\NewsI18n", mappedBy="newsItem")
     */
    protected $i18ns;

    /**
     * @ORM\OneToMany(targetEntity="app\models\NewsGallery", mappedBy="newsItem")
     */
    protected $galleries = [];

    public function __construct() {
        $this->i18ns = new ArrayCollection();
        $this->galleries = new ArrayCollection();
        $this->added = new \DateTime();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return NewsI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return NewsGallery[] */
    public function getGalleries() { return $this->galleries->toArray(); }

}