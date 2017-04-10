<?php

namespace sync\models;

class Product {

    /** @var string */
    public $id;

    /** @var Category|null */
    public $category;

    /** @var string */
    public $name;

    /** @var string */
    public $sku;

    /** @var float */
    public $price;

    /**
     * @param string $id
     * @param Category|null $category
     * @param string $name
     * @param string $sku
     * @param float $price
     */
    public function __construct($id, Category $category = null, $name, $sku, $price) {
        $this->id = $id;
        $this->category = $category;
        $this->name = $name;
        $this->sku = $sku;
        $this->price = $price;
    }

}