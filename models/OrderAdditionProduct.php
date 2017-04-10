<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с дополнительными товарами заказа
 * @ORM\Entity()
 */
class OrderAdditionProduct{

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\Order", inversedBy="orderProducts")
     * @ORM\JoinColumn(name="orderId", referencedColumnName="id")
     */
    protected $order;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\AdditionProduct")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    protected $product;

    /** @ORM\Column(type="integer") */
    protected $productId;

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @ORM\Column(type="string") */
    protected $sku = '';

    /** @ORM\Column(type="float") */
    protected $price = 0;

    /** @ORM\Column(type="integer") */
    protected $quantity = 0;

    /** @ORM\Column(type="integer") */
    protected $discount = 0;

    /** @return int */
    public function getId() { return $this->id; }

    /** @param int $id */
    public function setId($id) { $this->id = $id; }

    /** @return Order|null */
    public function getOrder() { return $this->order; }

    /** @param Order $order */
    public function setOrder($order) { $this->order = $order; }

    /** @return AdditionProduct|null */
    public function getProduct() { return $this->product; }

    /** @param AdditionProduct $product */
    public function setProduct($product) { $this->product = $product; }

    /** @return int */
    public function getProductId() { return $this->productId; }

    /** @param int $productId */
    public function setProductId($productId) { $this->productId = $productId; }

    /** @return null */
    public function getDiscount() { return $this->discount; }

    /** @param $discount */
    public function setDiscount($discount) { $this->discount = $discount; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return string */
    public function getSku() { return $this->sku; }

    /** @param string $sku */
    public function setSku($sku) { $this->sku = $sku; }

    /** @return float */
    public function getPrice() { return $this->price; }

    /** @param float $price */
    public function setPrice($price) { $this->price = $price; }

    /** @return int */
    public function getQuantity() { return $this->quantity; }

    /** @param int $quantity */
    public function setQuantity($quantity) { $this->quantity = $quantity; }

    /** @return float */
    public function getTotalCost() {
        $price = $this->price;
        if(!empty($this->getOptions())) {
            foreach($this->getOptions() as $option) {
                if(!$option->getMain()) {
                    $price += (int) $option->getI18n(Language::getCurrentLanguage())->getValue();
                }
            }
        }

        if(!empty($this->getDiscount())){
            $price = $price - ( ($price/100) * $this->getDiscount());
        }
        return $price * $this->quantity;
    }

    public function getCalculatedPrice(){
        $price = $this->price;
        if(!empty($this->getOptions())) {
            foreach($this->getOptions() as $option) {
                if(!$option->getMain()) {
                    $price += (int) $option->getI18n(Language::getCurrentLanguage())->getValue();
                }
            }
        }

        if(!empty($this->getDiscount())){
            $price = $price - ( ($price/100) * $this->getDiscount());
        }
        return $price;
    }

    /**
     * @ORM\ManyToMany(targetEntity="app\models\AdditionProductOption")
     * @ORM\JoinTable(
     *  name="OrderAdditionProductOption",
     *  joinColumns={
     *      @ORM\JoinColumn(name="productId", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="optionId", referencedColumnName="id")
     *  }
     * ) 
     */
    protected $options;

    public function __construct(){
        $this->options = new ArrayCollection();
    }


    /** @return AdditionProductOption[] */
    public function getOptions() { return $this->options; }

    /** @param AdditionProductOption[] $options */
    public function setOptions($options) { $this->options = $options; }
}