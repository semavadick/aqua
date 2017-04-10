<?php

namespace app\helpers;

use app\components\WebUser;
use app\models\Currency;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Entity;
use Yii;

/**
 * Хелпер для работы с ценами
 */
class PriceHelper {

    /** @var Currency */
    private $currency;

    /** @var WebUser */
    private $wUser = null;

    public function __construct(Currency $currency, WebUser $wUser = null) {
        $this->currency = $currency;
        $this->wUser = $wUser;
    }

    /**
     * @param Entity $product
     * @return float
     */
    public function getPrice(Entity $product, $discount = false) {
        return $product->getCalculatedPrice($this->currency, $this->wUser->getModel(), $discount);
    }


    /**
     * @param Entity $product
     * @return string
     */
    public function getFormattedPrice(Entity $product, $discount = false) {
        $price = $this->getPrice($product, $discount);
        if ($price == 0) return Yii::t('app', 'Request a price');
        if($this->currency->getId() == Currency::ID_RUB) {
            $price = number_format(round($price), 0, '.', ' ');
            $price .= '<span class="rub"> руб.</span>';
        } else {
            /* Попросили убрать для западников цены
            $price = number_format(round($price), 2, '.', ',');
            $price = '<span class="dollar">&euro; </span>' . $price;
            */
            if ($product->getIsOnOffer()){
              $price = Yii::t('app', 'Request a price');
            }
            else $price = Yii::t('app', 'Not in stock');
        }
        return $price;
    }

    public function getDiscount(Entity $product){
        $user = $this->wUser->getModel();
        return $product->getDiscount($user);
    }

    /**
     * @param Order $order
     * @param OrderProduct $product
     * @return string
     */
    public function getFormattedOrderProductPrice(Order $order, $product) {
        $price = $product->getCalculatedPrice();
        $currency = $order->getCurrency();
        if($currency->getId() == Currency::ID_RUB) {
            $price = number_format($price, 2, '.', ' ');
            $price .= '<span class="rub"> руб.</span>';
        } else {
            $price = number_format($price, 2, '.', ',');
            $price = '<span class="dollar">&euro; </span>' . $price;
        }
        return $price;
    }

    /**
     * @param Order $order
     * @param $product
     * @return string
     */
    public function getFormattedOrderProductTotalCost(Order $order, $product) {
        $price = $product->getTotalCost();
        $currency = $order->getCurrency();
        if($currency->getId() == Currency::ID_RUB) {
            $price = number_format($price, 2, '.', ' ');
            $price .= '<span class="rub"> руб.</span>';
        } else {
            $price = number_format($price, 2, '.', ',');
            $price = '<span class="dollar">&euro; </span>' . $price;
        }
        return $price;
    }


    /**
     * @param Order $order
     * @return string
     */
    public function getFormattedOrderPrice(Order $order) {
        $price = $order->getTotalCost();
        $currency = $order->getCurrency();
        if(empty($currency) || $currency->getId() == Currency::ID_RUB) {
            $price = number_format($price, 2, '.', ' ');
            $price .= ' руб.';
        } else {
            $price = number_format($price, 2, '.', ',');
            $price = '&euro; ' . $price;
        }
        return $price;
    }

    public function formatPrice($price) {
        if($this->currency->getId() == Currency::ID_RUB) {
            $price = number_format(round($price), 0, '.', ' ');
            $price .= '<span class="rub"> руб.</span>';
        } else {
            $price = number_format(round($price), 2, '.', ',');
            $price = '<span class="dollar">&euro; </span>' . $price;
        }
        return $price;
    }

}