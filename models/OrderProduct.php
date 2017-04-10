<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с товарами заказа
 * @ORM\Entity()
 */
class OrderProduct {

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
     * @ORM\ManyToOne(targetEntity="app\models\Product")
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

    /** @return Product|null */
    public function getProduct() { return $this->product; }

    /** @param Product $product */
    public function setProduct($product) { $this->product = $product; }

    /** @return null */
    public function getDiscount() { return $this->discount; }

    /** @param $discount */
    public function setDiscount($discount) { $this->discount = $discount; }

    /** @return int */
    public function getProductId() { return $this->productId; }

    /** @param int $productId */
    public function setProductId($productId) { $this->productId = $productId; }

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
        if(!empty($this->getDiscount())) {
            $price = $price - ( ($price/100) * $this->getDiscount());
        }
        return $price * $this->quantity;
    }

    public function getCalculatedPrice(){
        $price = $this->price;
        if(!empty($this->getDiscount())){
            $price = $price - ( ($price/100) * $this->getDiscount());
        }
        return $price;
    }

}