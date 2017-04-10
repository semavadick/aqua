<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с фильтром категории
 * @ORM\Entity()
 */
class CategoryFilter extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\Category", inversedBy="filters")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="app\models\CategoryFilterI18n", mappedBy="filter")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return CategoryFilterI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return Category */
    public function getCategory() { return $this->category; }

    /** @param Category $category */
    public function setCategory($category) { $this->category = $category; }

    public function getText() {
        /** @var CategoryFilterI18n|null $i18n */
        $i18n = $this->getDefaultI18n();
        if(empty($i18n)) {
            return null;
        }
        return $i18n->getText();
    }

}