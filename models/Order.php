<?php

namespace app\models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use Yii;

/**
 * Класс для работы с заказами
 * @ORM\Entity(repositoryClass="app\repositories\OrdersRepository")
 * @ORM\Table(name="`Order`")
 */
class Order extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * @var int Статус
     */
    protected $status = self::STATUS_PRE_PROCESSING;

    /** Статус Оформляется */
    const STATUS_PRE_PROCESSING = 0;

    /** Статус В работе */
    const STATUS_PROCESSING = 1;

    /** Статус Доставлен */
    const STATUS_DELIVERED = 2;

    /** Статус Отменен */
    const STATUS_CANCELED = 3;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime Дата добавления
     */
    protected $added = '';

    /**
     * @ORM\Column(type="float")
     * @var float Скидка
     */
    protected $discount;

    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    protected $userId;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\User", inversedBy="orders")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     * @var User|null
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="app\models\Currency")
     * @ORM\JoinColumn(name="currencyId", referencedColumnName="id")
     * @var Currency|null
     */
    protected $currency;

    /**
     * @ORM\OneToMany(targetEntity="app\models\OrderProduct", mappedBy="order")
     * @var OrderProduct[]
     */
    protected $orderProducts = [];

    /**
     * @ORM\OneToMany(targetEntity="app\models\OrderAdditionProduct", mappedBy="order")
     * @var OrderAdditionProduct[]
     */
    protected $orderAdditionProducts = [];

    public function __construct() {
        $this->orderProducts = new ArrayCollection();
        $this->orderAdditionProducts = new ArrayCollection();
        $this->added = new \DateTime();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return array */
    public function getI18ns() { return []; }

    /** @return int */
    public function getStatus() { return $this->status; }

    /** @param int $status */
    public function setStatus($status) { $this->status = $status; }

    /** @return DateTime */
    public function getAdded() { return $this->added; }

    /** @param DateTime $added */
    public function setAdded($added) { $this->added = $added; }

    /** @return float */
    public function getDiscount() { return $this->discount; }

    /** @param float $discount */
    public function setDiscount($discount) { $this->discount = $discount; }

    /** @return User|null */
    public function getUser() { return $this->user; }

    /** @param User|null $user */
    public function setUser($user) { $this->user = $user; }

    /** @return OrderProduct[] */
    public function getOrderProducts() { return $this->orderProducts; }

    /** @param OrderProduct[] $orderProducts */
    public function setOrderProducts($orderProducts) { $this->orderProducts = $orderProducts; }

    /** @return OrderAdditionProduct[] */
    public function getOrderAdditionProducts() { return $this->orderAdditionProducts; }

    /** @param OrderAdditionProduct[] $orderAdditionProducts */
    public function setOrderAdditionProducts($orderAdditionProducts) { $this->orderAdditionProducts = $orderAdditionProducts; }

    /** @return float */
    public function getTotalCost() {
        $cost = 0;
        foreach($this->orderProducts as $orderProduct) {
            $cost += $orderProduct->getTotalCost();
        }
        foreach($this->orderAdditionProducts as $orderAdditionProduct) {
            $cost += $orderAdditionProduct->getTotalCost();
        }

        if(!empty($this->discount)) {
            $cost *= round((100 - $this->discount) / 100);
        }
        return $cost;
    }

    /** @return string */
    public function getStatusLabel() {
        $statuses = [
            self::STATUS_PRE_PROCESSING => 'Оформляется',
            self::STATUS_PROCESSING => 'В работе',
            self::STATUS_DELIVERED => 'Доставлен',
            self::STATUS_CANCELED => 'Отменен',
        ];
        return $statuses[$this->status];
    }

    /**
     * @return string
     */
    public function getStatusLabelI18n() {
        $statuses = [
            self::STATUS_PRE_PROCESSING => Yii::t('app', 'pre processing'),
            self::STATUS_PROCESSING => Yii::t('app', 'processing'),
            self::STATUS_DELIVERED => Yii::t('app', 'delivered'),
            self::STATUS_CANCELED => Yii::t('app', 'canceled'),
        ];
        return $statuses[$this->status];
    }

    /** @return Currency|null */
    public function getCurrency() { return $this->currency; }

    /** @param Currency $currency */
    public function setCurrency($currency) { $this->currency = $currency; }

    /**
     * @return string
     */
    public function getFormattedDate() {
        return $this->added->format('d.m.Y / H:i');
    }

}