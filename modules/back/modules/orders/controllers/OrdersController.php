<?php

namespace back\Orders\controllers;

use app\repositories\UsersRepository;
use back\controllers\TableCrudController;
use app\models\Entity;
use app\models\Order;
use back\Orders\forms\OrderForm;
use back\Orders\forms\OrdersSearchForm;

class OrdersController extends TableCrudController {

    public function actionClients() {
        $users = UsersRepository::getInstance()->findAllClients();
        $clients = [];
        foreach($users as $user) {
            $clients[] = [
                'id' => $user->getId(),
                'text' => $user->getFullNameWithEmail(),
            ];
        }
        return $this->getResponse($clients);
    }

    /** @inheritdoc */
    protected function createEntityForm() {
        return new OrderForm();
    }

    /**
     * @inheritdoc
     */
    protected function getEntityRepository() {
        return $this->getEntityManager()->getRepository('Models:Order');
    }

    /**
     * @inheritdoc
     * @param Order $entity
     */
    protected function getEntityDataForGrid(Entity $entity) {
        $user = $entity->getUser();
        return [
            'id' => $entity->getId(),
            'client' => !empty($user) ? $user->getFullNameWithEmail() : null,
            'statusLabel' => $entity->getStatusLabel(),
            'totalCost' => $entity->getTotalCost(),
            'added' => $entity->getAdded()->format('Y-m-d H:i:s'),
        ];
    }

    /** @inheritdoc */
    protected function createSearchForm() {
        return new OrdersSearchForm();
    }

    /** @inheritdoc */
    protected function checkAccess() {
        return $this->getWebUser()->canManageOrders();
    }

}