<?php

namespace back\Orders\forms;

use app\models\Entity;
use app\models\Language;
use app\models\Order;
use app\models\OrderProduct;
use app\models\OrderAdditionProduct;
use back\forms\EntityForm;

class OrderForm extends EntityForm {

    public $status = Order::STATUS_PRE_PROCESSING;
    public $discount = null;

    public $orderProducts = [];
    public $orderAdditionProducts = [];
    /** @var OrderProduct[] */
    private $orderProductsToDelete = [];

    /** @var OrderAdditionProduct[] */
    private $orderAdditionProductsToDelete = [];

    public function rules() {
        $rules = [
            [['status', 'orderProducts','orderAdditionProducts'], 'safe'],
            ['discount', 'number', 'min' => 0, 'max' => 100],
        ];
        return $rules;
    }

    public function attributeLabels() {
        return [
            'discount' => 'Общая скидка',
        ];
    }

    /**
     * @inheritdoc
     * @param Order $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->status = $entity->getStatus();
        $this->discount = $entity->getDiscount();
        foreach($entity->getOrderProducts() as $orderProduct) {
            $this->orderProducts[] = [
                'id' => $orderProduct->getId(),
                'sku' => $orderProduct->getSku(),
                'name' => $orderProduct->getName(),
                'price' => $orderProduct->getPrice(),
                'quantity' => $orderProduct->getQuantity(),
                'discount' => $orderProduct->getDiscount()
            ];
            $this->orderProductsToDelete[$orderProduct->getId()] = $orderProduct;
        }
        if($entity->getOrderAdditionProducts()){
            foreach($entity->getOrderAdditionProducts() as $orderAdditionProduct){
                $options = [];
                foreach($orderAdditionProduct->getOptions() as $option) {
                    $options[$option->getId()] = [
                       'id' => $option->getId(),
                        'type' => $option->getType(),
                        'main' => $option->getMain(),
                        'name' => $option->getI18n(Language::getCurrentLanguage())->getName(),
                        'value' => $option->getI18n(Language::getCurrentLanguage())->getValue()
                    ];
                }
                $this->orderAdditionProducts[] = [
                    'id' => $orderAdditionProduct->getId(),
                    'sku' => $orderAdditionProduct->getSku(),
                    'name' => $orderAdditionProduct->getName(),
                    'price' => $orderAdditionProduct->getPrice(),
                    'quantity' => $orderAdditionProduct->getQuantity(),
                    'options' => $options,
                    'discount' => $orderAdditionProduct->getDiscount()
                ];
                $this->orderAdditionProductsToDelete[$orderAdditionProduct->getId()] = $orderAdditionProduct;
            }
        }
    }

    /**
     * @inheritdoc
     * @param Order $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setStatus($this->status);
        $entity->setDiscount($this->discount ? $this->discount : null);

        foreach($this->orderProducts as $data) {
            if(empty($data['id']) || empty($data['quantity']) || !isset($this->orderProductsToDelete[$data['id']])) {
                continue;
            }
            $orderProduct = $this->orderProductsToDelete[$data['id']];
            unset($this->orderProductsToDelete[$data['id']]);
            $orderProduct->setQuantity(intval($data['quantity']));
            $this->getEntityManager()->persist($orderProduct);
        }
        foreach($this->orderProductsToDelete as $orderProduct) {
            $this->getEntityManager()->remove($orderProduct);
        }

        foreach($this->orderAdditionProducts as $data) {
            if(empty($data['id']) || empty($data['quantity']) || !isset($this->orderAdditionProductsToDelete[$data['id']])) {
                continue;
            }
            $orderAdditionProduct = $this->orderAdditionProductsToDelete[$data['id']];
            unset($this->orderAdditionProductsToDelete[$data['id']]);
            $orderAdditionProduct->setQuantity(intval($data['quantity']));
            $this->getEntityManager()->persist($orderAdditionProduct);
        }
        foreach($this->orderAdditionProductsToDelete as $orderAdditionProduct) {
            $this->getEntityManager()->remove($orderAdditionProduct);
        }

        return true;
    }

    /**
     * @inheritdoc
     * @param Order $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        $user = $entity->getUser();
        return [
            'clientFullName' => !empty($user) ? $user->getFullName() : null,
            'clientEmail' => !empty($user) ? $user->getEmail() : null,
            'clientPhone' => !empty($user) ? $user->getPhone() : null,
            'added' => $entity->getAdded()->format('Y-m-d H:i:s'),
        ];
    }

    /** @inheritdoc */
    protected function createNewEntity() {
        return null;
    }

    /** @inheritdoc */
    protected function createNewI18nForm() {
        return null;
    }

}