<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="app\repositories\CurrenciesRepository")
 */
class Currency {

    const ID_DEFAULT = 1;
    const ID_RUB = 1;
    const ID_EURO = 2;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /**
     * @ORM\Column(type="float")
     * @var float Ставка (относительно дефолтной валюты)
     */
    protected $rate;

    /** @return int */
    public function getId() { return $this->id; }

    /** @return float */
    public function getRate() { return $this->rate; }

    /** @param float $rate */
    public function setRate($rate) { $this->rate = $rate; }

}