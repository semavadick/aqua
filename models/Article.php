<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы со статьями
 * @ORM\Entity(repositoryClass="app\repositories\ArticlesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Article extends Publication {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ArticleI18n", mappedBy="article")
     */
    protected $i18ns;

    /**
     * @ORM\ManyToMany(targetEntity="app\models\Category")
     * @ORM\JoinTable(
     *  name="ArticleCategory",
     *  joinColumns={
     *      @ORM\JoinColumn(name="articleId", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     *  }
     * )
     */
    protected $categories;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ArticleGallery", mappedBy="article")
     */
    protected $galleries = [];

    public function __construct() {
        $this->i18ns = new ArrayCollection();
        $this->galleries = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->added = new \DateTime();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return ArticleI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return ArticleGallery[] */
    public function getGalleries() { return $this->galleries->toArray(); }

    /** @return Category[] */
    public function getCategories() { return $this->categories; }

    /** @param Category[] $categories */
    public function setCategories($categories) { $this->categories = $categories; }

    /**
     * @return Category|null
     */
    public function getCategory() {
        return !empty($this->categories) ? $this->categories[0] : null;
    }

}