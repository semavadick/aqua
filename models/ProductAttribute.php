<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с атрибутом товара
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class ProductAttribute extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\Product", inversedBy="attributes")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    protected $product;

    /**
     * @ORM\OneToMany(targetEntity="app\models\ProductAttributeI18n", mappedBy="attribute")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return ProductAttributeI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return Product */
    public function getProduct() { return $this->product; }

    /** @param Product $product */
    public function setProduct($product) { $this->product = $product; }


}