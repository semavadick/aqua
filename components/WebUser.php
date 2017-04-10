<?php

namespace app\components;

use app\models\AdditionProduct;
use app\models\Product;
use app\repositories\AdditionProductsRepository;
use app\repositories\ProductsRepository;
use Yii;
use app\models\User;
use yii\rbac\Role;
use app\repositories\UsersRepository;

/**
 * Компонент web-пользователя
 */
class WebUser extends \yii\web\User {

    /**
     * @var User|null Модель пользователя
     */
    private $model = false;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        $model = $this->getModel();
        // Проверяем статус пользователя
        if(empty($model) || !$model->isActive()) {
            $this->logout();
            return;
        }
    }

    /**
     * @inheritdoc
     */
    protected function afterLogin($identity, $cookieBased, $duration) {
        parent::afterLogin($identity, $cookieBased, $duration);

        // Регенерируем authKey для identity
        if(!$cookieBased) {
            /* @var UserIdentity $identity */
            if(!$identity->regenerateAuthKey()) {
                $this->logout();
                return;
            }
            $this->switchIdentity($identity, $duration);
        }
    }

    /**
     * @return User Модель пользователя
     */
    public function getModel() {
        if($this->model === false) {
            $this->model = UsersRepository::getInstance()->findUserById($this->getId());
        }

        return $this->model;
    }

    /** @return bool Может ли управлять главной страницей */
    public function canManageMainPage() { return $this->isManager() || $this->isAdmin(); }

    /** @return bool Может ли управлять страницей О компании */
    public function canManageAboutPage() { return $this->isManager() || $this->isAdmin(); }

    /** @return bool Может ли управлять страницей Строительство бассейнов */
    public function canManagePoolsBuildingPage() { return $this->isManager() || $this->isAdmin(); }

    /** @return bool Может ли управлять Галереями объектов */
    public function canManageObjectGalleries() { return $this->isManager() || $this->isAdmin(); }

    /** @return bool Может ли управлять новостями */
    public function canManageNews() { return $this->isManager() || $this->isAdmin(); }

    /** @return bool Может ли управлять статьями */
    public function canManageArticles() { return $this->isManager() || $this->isAdmin(); }

    /** @return bool Может ли управлять услугами */
    public function canManageServices() { return $this->isManager() || $this->isAdmin(); }

    /** @return bool Может ли управлять каталогом */
    public function canManageCatalog() { return $this->isManager() || $this->isAdmin(); }

    /** @return bool Может ли управлять пользователями */
    public function canManageUsers() { return $this->isAdmin(); }

    /** @return bool Может ли управлять заказами */
    public function canManageOrders() { return $this->isAdmin(); }

    /** @return bool Может ли управлять настройками */
    public function canManageSettings() { return $this->isAdmin(); }

    /** @return bool Является ли менеджером */
    private function isManager() {
        $model = $this->getModel();
        return !empty($model) && $model->getRole() == $model::ROLE_MANAGER;
    }

    /** @return bool Является ли админом */
    private function isAdmin() {
        $model = $this->getModel();
        return !empty($model) && $model->getRole() == $model::ROLE_ADMIN;
    }


    private $cartProducts = null;

    /**
     * @return Product[] Товары в корзине
     */
    public function getCartProducts() {
        if(is_null($this->cartProducts)) {
            $this->cartProducts = [];
            $cData = Yii::$app->getSession()->get('cartProducts');
            $sProducts = json_decode($cData, true);
            if(is_array($sProducts)) {
                $productIDs = [];
                $productQuantities = [];
                $productOptions = [];
                foreach($sProducts as $sProduct) {
                    if(!isset($sProduct['id']) || !isset($sProduct['quantity']))
                        continue;

                    $prType = (!empty($sProduct['type'])) ? $sProduct['type'] : 0;
                    $productIDs[$prType][] = intval($sProduct['id']);
                    $productQuantities[$prType][$sProduct['id']] = intval($sProduct['quantity']);
                    if(!empty($sProduct['options'])) {
                        $productOptions[$prType][$sProduct['id']] = $sProduct['options'];
                    }
                }
                if(empty($productIDs)) {
                    $this->setCartProducts([]);
                    return [];
                }

                foreach($productIDs as $prType => $ids) {
                    switch($prType) {
                        case 1: {
                            $products = AdditionProductsRepository::getInstance()->findProductsForCart($ids);
                            break;
                        }
                        default: {
                            $products = ProductsRepository::getInstance()->findProductsForCart($ids);
                        }
                    }
                    foreach($products as &$product) {
                        if(!isset($productQuantities[$prType][$product->getId()]))
                            continue;

                        if(isset($productOptions[$prType][$product->getId()])) {
                            $product->setCartOptions($productOptions[$prType][$product->getId()]);
                        }
                        $product->setCartQuantity($productQuantities[$prType][$product->getId()]);
                        $this->cartProducts[] = $product;
                    }
                }
            }
        }
        $this->setCartProducts($this->cartProducts);

        return $this->cartProducts;
    }

    /**
     * @param Product[] $products Товары в корзине
     */
    public function setCartProducts($products) {
        $sProducts = [];
        $this->cartProducts = [];
        foreach($products as $product) {
            $prType = ($product instanceof AdditionProduct) ? 1 : 0;
            $prod = [
                'id' => $product->getId(),
                'quantity' => $product->getCartQuantity(),
                'type' => $prType
            ];
            if($prType != 0 && !empty($product->getCartOptions())) {
                $options = $product->getCartOptions();
                foreach($options as $option) {
                    $option['id'] = (int) $option['id'];
                    $option['type'] = (int) $option['type'];
                    if(isset($option['main'])) $option['main'] = (int) $option['main'];
                    $prod['options'][$option['id']] = $option;
                }
            }
            $sProducts[] = $prod;
            $this->cartProducts[] = $product;
        }

        Yii::$app->getSession()->set('cartProducts', json_encode($sProducts));
    }

    /**
     * Очищает корзину посетителя
     */
    public function cleanCart() {
        $this->setCartProducts([]);
    }

    /** @return string|null */
    public function getFirstName() {
        $model = $this->getModel();
        if(empty($model)) {
            return null;
        }
        return explode(' ', $model->getFullName())[0];
    }

} 