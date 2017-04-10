<?php

namespace app\models;

use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с опцией товара
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AdditionProductOption extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $type = 0;

    /** @ORM\Column(type="integer") */
    protected $main = 0;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\AdditionProduct", inversedBy="options")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    protected $product;
    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionProductOptionI18n", mappedBy="option")
     */
    protected $i18ns;

    const OPTION_DEFAULT_TYPE = 1;
    const OPTION_DEPTH_TYPE = 2;
    const OPTION_WIDTH_TYPE = 3;
    const OPTION_DIAMETER_TYPE = 4;
    const OPTION_LENGTH_TYPE = 5;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return AdditionProductOptionI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return AdditionProduct */
    public function getProduct() { return $this->product; }

    /** @param AdditionProduct $product */
    public function setProduct($product) { $this->product = $product; }

    /** @return int */
    public function getType() { return $this->type; }

    /** @param int $type */
    public function setType($type) { $this->type = $type; }

    /** @return int */
    public function getMain() { return $this->main; }

    /** @param int $main */
    public function setMain($main) { $this->main = $main; }



}