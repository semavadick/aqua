<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с информационной вкладкой товара
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AdditionProductTab extends Entity {

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
     * @ORM\ManyToOne(targetEntity="app\models\AdditionProduct", inversedBy="tabs")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    protected $product;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionProductTabI18n", mappedBy="tab")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return AdditionProductImageI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return AdditionProduct */
    public function getProduct() { return $this->product; }

    /** @param AdditionProduct $product */
    public function setProduct($product) { $this->product = $product; }
}