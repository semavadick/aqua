<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с категориями
 * @ORM\Entity(repositoryClass="app\repositories\AdditionCategoriesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class AdditionCategory extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /** @ORM\Column(type="boolean") */
    protected $hasDiscount = 0;

    /** @ORM\Column(type="string") */
    protected $imagePath = '';

    /** @ORM\Column(type="string") */
    protected $bgPath = '';

    /** @ORM\Column(type="string") */
    protected $smallBgPath = '';

    /**
     * @ORM\Column(type="string")
     * @var string Id для импорта
     */
    protected $importId;

    /**
     * @ORM\ManyToMany(targetEntity="app\models\AdditionCategory")
     * @ORM\JoinTable(
     *  name="AdditionCategoryRelation",
     *  joinColumns={
     *      @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="relatedAdditionCategoryId", referencedColumnName="id")
     *  }
     * )
     */
    protected $relatedCategories;

    const BG_WIDTH = 1320;
    const BG_HEIGHT = 432;

    const SMALL_BG_WIDTH = 660;
    const SMALL_BG_HEIGHT = 216;

    CONST IMAGE_MAX_WIDTH = 300;
    CONST IMAGE_MAX_HEIGHT = 300;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionCategoryI18n", mappedBy="AdditionCategory")
     */
    protected $i18ns;

    /** @ORM\Column(type="integer") */
    protected $parentId;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\AdditionCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parentId", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionCategory", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionProduct", mappedBy="category")
     */
    protected $products;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionCategoryFilter", mappedBy="AdditionCategory")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */
    protected $filters = [];

    public function __construct() {
        $this->i18ns = new ArrayCollection();
        $this->filters = new ArrayCollection();
        $this->relatedCategories = new ArrayCollection();
        $this->children = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return AdditionCategoryI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string */
    public function getBgPath() { return $this->bgPath; }

    /** @param string $bgPath */
    public function setBgPath($bgPath) { $this->bgPath = $bgPath; }

    /** @return string */
    public function getSmallBgPath() { return $this->smallBgPath; }

    /** @param string $smallBgPath */
    public function setSmallBgPath($smallBgPath) { $this->smallBgPath = $smallBgPath; }

    /** @return AdditionCategoryFilter[] */
    public function getFilters() { return $this->filters->toArray(); }

    /**
     * @param $id
     * @return AdditionCategoryFilter|null
     */
    public function getFilterById($id) {
        foreach($this->getFilters() as $filter) {
            if($filter->getId() == $id) {
                return $filter;
            }
        }
        return null;
    }

    /** @param AdditionCategoryFilter[] $filters */
    public function setFilters($filters) { $this->filters = $filters; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->imagePath);
        MagicImage::deleteImage($this->bgPath);
        MagicImage::deleteImage($this->smallBgPath);
    }

    /** @return int */
    public function getSort() { return $this->sort; }

    /** @param int $sort */
    public function setSort($sort) { $this->sort = $sort; }

    /** @return string */
    public function getImagePath() { return $this->imagePath; }

    /** @param string $imagePath */
    public function setImagePath($imagePath) { $this->imagePath = $imagePath; }

    /** @return AdditionCategory[] */
    public function getRelatedCategories() { return $this->relatedCategories->toArray(); }

    /** @return AdditionCategory[] */
    public function getAllRelatedCategories() {
        $categories = $this->getRelatedCategories();
        foreach($this->getChildren() as $child) {
            $categories = array_merge($categories, $child->getRelatedCategories());
        }
        return $categories;
    }

    /** @param AdditionCategory[] $relatedCategories */
    public function setRelatedCategories($relatedCategories) { $this->relatedCategories = $relatedCategories; }

    /** @return AdditionCategory|null */
    public function getParent() { return $this->parent; }

    /** @param AdditionCategory|null $parent */
    public function setParent($parent) { $this->parent = $parent; }

    /** @return AdditionProduct[] */
    public function getProducts() { return $this->products; }

    /** @param AdditionProduct[] $products */
    public function setProducts($products) { $this->products = $products; }

    /** @return AdditionCategory[] */
    public function getChildren() {
        $children = $this->children->toArray();
        usort($children, function(AdditionCategory $cat1, AdditionCategory $cat2) {
            return $cat1->getSort() - $cat2->getSort();
        });
        return $children;
    }

    /** @param AdditionCategory[] $children */
    public function setChildren($children) { $this->children = $children; }

    public function getName() {
        /** @var AdditionCategoryI18n|null $i18n */
        $i18n = $this->getDefaultI18n();
        if(empty($i18n)) {
            return null;
        }
        return $i18n->getName();
    }

    /** @return boolean */
    public function getHasDiscount() { return $this->hasDiscount; }

    /** @param boolean $hasDiscount */
    public function setHasDiscount($hasDiscount) { $this->hasDiscount = $hasDiscount; }

    /** @return boolean */
    public function hasChildWithDiscount() {
        foreach($this->getChildren() as $child) {
            if($child->getHasDiscount() || $child->hasChildWithDiscount()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Entity $child
     * @return bool
     */
    public function hasChild(Entity $child) {
        foreach($this->getChildren() as $tChild) {
            if($tChild->getId() == $child->getId() || $tChild->hasChild($child)) {
                return true;
            }
        }
        return false;
    }

    /** @return string */
    public function getImportId() { return $this->importId; }

    /** @param string $importId */
    public function setImportId($importId) { $this->importId = $importId; }

    /** @return int[] */
    public function getChildrenIds() {
        $ids = [];
        foreach($this->getChildren() as $child) {
            $ids[] = $child->getId();
            $ids = array_merge($ids, $child->getChildrenIds());
        }
        return $ids;
    }

}