<?php

namespace app\models;

use app\repositories\CurrenciesRepository;
use back\helpers\HandyFile;
use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с товарами
 * @ORM\Entity(repositoryClass="app\repositories\AdditionProductsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class AdditionProduct extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $previewPath = '';

    CONST PREVIEW_MAX__WIDTH = 300;
    CONST PREVIEW_MAX_HEIGHT = 300;

    /** @ORM\Column(type="string") */
    protected $sku = '';

    /** @ORM\Column(type="boolean") */
    protected $isOnOffer = true;

    /** @ORM\Column(type="boolean") */
    protected $kupelType = false;

    /** @ORM\Column(type="float") */
    protected $price = 0;

    /** @ORM\Column(type="string") */
    protected $figure = '';

    /** @ORM\Column(type="string") */
    protected $draftPath = '';

    /** @ORM\Column(type="string") */
    protected $circuitPath = '';

    /** @ORM\Column(type="string") */
    protected $certificatePath = '';

    /** @ORM\Column(type="integer") */
    protected $sort;

    /**
     * @ORM\Column(type="string")
     * @var string Id для импорта
     */
    protected $importId;

    /**
     * @ORM\ManyToMany(targetEntity="app\models\Product")
     * @ORM\JoinTable(
     *  name="AdditionProductRelation",
     *  joinColumns={
     *      @ORM\JoinColumn(name="productId", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="relatedProductId", referencedColumnName="id")
     *  }
     * )
     */
    protected $relatedProducts;

    /**
     * @ORM\ManyToMany(targetEntity="app\models\AdditionProduct")
     * @ORM\JoinTable(
     *  name="AdditionProductAdditionRelation",
     *  joinColumns={
     *      @ORM\JoinColumn(name="productId", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="relatedProductId", referencedColumnName="id")
     *  }
     * )
     */
    protected $relatedAdditionProducts;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionProductI18n", mappedBy="product")
     */
    protected $i18ns;

    /** @ORM\Column(type="integer") */
    protected $categoryId;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\AdditionCategory", inversedBy="products")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionProductTab", mappedBy="product")
     */
    protected $tabs;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionProductOption", mappedBy="product")
     */
    protected $options;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionProductImage", mappedBy="product")
     * @ORM\OrderBy({"sort" = "ASC"})
     */
    protected $images;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
        $this->relatedProducts = new ArrayCollection();
        $this->relatedAdditionProducts = new ArrayCollection();
        $this->tabs = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return AdditionProductI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @ORM\PostRemove() */
    public function removeAssets() {
        MagicImage::deleteImage($this->previewPath);
        HandyFile::deleteFile($this->certificatePath);
        HandyFile::deleteFile($this->circuitPath);
        HandyFile::deleteFile($this->draftPath);
    }

    /** @return Product[] */
    public function getRelatedProducts() { return $this->relatedProducts; }

    /** @param Product[] $relatedProducts */
    public function setRelatedProducts($relatedProducts) { $this->relatedProducts = $relatedProducts; }

    /** @return AdditionProduct[] */
    public function getRelatedAdditionProducts() { return $this->relatedAdditionProducts; }

    /** @param AdditionProduct[] $relatedAdditionProducts */
    public function setRelatedAdditionProducts($relatedAdditionProducts) { $this->relatedAdditionProducts = $relatedAdditionProducts; }

    /** @return AdditionCategory|null */
    public function getCategory() { return $this->category; }

    /** @param AdditionCategory|null $category */
    public function setCategory($category) { $this->category = $category; }

    public function getName(Language $language = null) {
        /** @var AdditionCategoryI18n|null $i18n */
        $i18n = !empty($language) ? $this->getI18n($language) : $this->getDefaultI18n();
        if(empty($i18n)) {
            return null;
        }
        return $i18n->getName();
    }

    /** @return AdditionProductTab[] */
    public function getTabs() { return $this->tabs; }

    /** @param AdditionProductTab[] $tabs */
    public function setTabs($tabs) { $this->tabs = $tabs; }

    /** @return AdditionProductOption[] */
    public function getOptions() { return $this->options; }

    /** @param AdditionProductOption[] $options */
    public function setOptions($options) { $this->options = $options; }

    /** @return string */
    public function getPreviewPath() { return $this->previewPath; }

    /** @param string $previewPath */
    public function setPreviewPath($previewPath) { $this->previewPath = $previewPath; }

    /** @return string */
    public function getSku() { return $this->sku; }

    /** @param string $sku */
    public function setSku($sku) { $this->sku = $sku; }

    /** @return integer */
    public function getSort() { return $this->sort; }

    /** @param integer $sort */
    public function setSort($sort) { $this->sort = $sort; }

    /** @return boolean */
    public function getIsOnOffer() { return $this->isOnOffer; }

    /** @param boolean $kupelType */
    public function setKupelType($kupelType) { $this->kupelType = $kupelType; }

    /** @return boolean */
    public function getKupelType() { return $this->kupelType; }

    /** @param boolean $isOnOffer */
    public function setIsOnOffer($isOnOffer) { $this->isOnOffer = $isOnOffer; }

    /** @return float */
    public function getPrice() {
        $price = $this->price;
        return $price;
    }

    /** @param float $price */
    public function setPrice($price) { $this->price = $price; }

    /** @return string */
    public function getDraftPath() { return $this->draftPath; }

    /** @param string $draftPath */
    public function setDraftPath($draftPath) { $this->draftPath = $draftPath; }

    /** @return boolean */
    public function hasDraft() { return !empty($this->draftPath); }

    /** @return string */
    public function getCircuitPath() { return $this->circuitPath; }

    /** @param string $circuitPath */
    public function setCircuitPath($circuitPath) { $this->circuitPath = $circuitPath; }

    /** @return boolean */
    public function hasCircuit() { return !empty($this->circuitPath); }

    /** @return string */
    public function getCertificatePath() { return $this->certificatePath; }

    /** @param string $certificatePath */
    public function setCertificatePath($certificatePath) { $this->certificatePath = $certificatePath; }

    /** @return boolean */
    public function hasCertificate() { return !empty($this->certificatePath); }

    /** @return AdditionProductImage[] */
    public function getImages() { return $this->images; }

    /** @param AdditionProductImage[] $images */
    public function setImages($images) { $this->images = $images; }

    /** @return string */
    public function getFigure() { return $this->figure; }

    /** @param string $figure */
    public function setFigure($figure) { $this->figure = $figure; }

    /** @return boolean */
    public function hasFigure() { return !empty($this->figure); }

    /** @var Currency|null */
    private static $currency = null;

    /** @return Currency */
    protected function getCurrency() {
        if(empty(self::$currency)) {
            self::$currency = CurrenciesRepository::getInstance()->find(Currency::ID_RUB);
        }
        return self::$currency;
    }

    /**
     * @param Currency $currency
     * @param User|null $user
     * @param $withDiscount = false
     * @return float
     */
    public function getCalculatedPrice(Currency $currency, User $user = null, $withDiscount = false) {
        // TODO;
        if($withDiscount && !empty($user)) {
            $discount = $this->getDiscount($user);
            $price = $this->getPrice() - (($this->price / 100) * $discount);
        } else {
            $price = $this->getPrice();
        }
        return $price  / $this->getCurrency()->getRate() * $currency->getRate();
    }

    public function getDiscount(User $user = null){
        if (!$user) return 0;
        $discount = (!empty($user->getDiscount())) ? $user->getDiscount() : 0;
        if(!$discount && !empty($user->getAdditionCategoriesDiscounts())) {
            foreach($user->getAdditionCategoriesDiscounts() as $category) {
                if($this->getCategory()->getId() == $category->getCategory()->getId()) {
                    $discount = $category->getDiscount();
                    break;
                }
            }
        }
        return $discount;
    }

    protected $cartQuantity = 0;

    protected $cartOptions = [];

    /** @return int */
    public function getCartQuantity() { return $this->cartQuantity; }

    /** @param int $cartQuantity */
    public function setCartQuantity($cartQuantity) { $this->cartQuantity = $cartQuantity; }

    /** @return array */
    public function getCartOptions() { return $this->cartOptions; }

    /** @param array $cartOptions */
    public function setCartOptions($cartOptions) { $this->cartOptions = $cartOptions; }

    /** @return string */
    public function getImportId() { return $this->importId; }

    /** @param string $importId */
    public function setImportId($importId) { $this->importId = $importId; }

}