<?php

namespace app\repositories;

use app\models\Order;

/**
 * Репозиторий заказов
 */
class OrdersRepository extends Repository {

    /** @return OrdersRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Order'); }

    /**
     * @return int Общее кол-во заказов
     */
    public function getTotalOrdersCount() {
        $qb = $this->createQueryBuilder('order1');
        $qb->select($qb->expr()->count('order1.id'));
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

    /**
     * @return int Кол-во заказов в оформлении
     */
    public function getPreProcessingOrdersCount() {
        $qb = $this->createQueryBuilder('order1');
        $qb->andWhere($qb->expr()->eq('order1.status', ':status'))
            ->setParameter('status', Order::STATUS_PRE_PROCESSING);
        $qb->select($qb->expr()->count('order1.id'));
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

    /**
     * @return int Кол-во заказов в работе
     */
    public function getProcessingOrdersCount() {
        $qb = $this->createQueryBuilder('order1');
        $qb->andWhere($qb->expr()->eq('order1.status', ':status'))
            ->setParameter('status', Order::STATUS_PROCESSING);
        $qb->select($qb->expr()->count('order1.id'));
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

    /**
     * @return float Сумма заказов за неделю
     */
    public function getOrdersWeeklySum() {
        $qb = $this->createQueryBuilder('order1');
        $qb->andWhere($qb->expr()->gt('order1.added', ':added'))
            ->setParameter('added', date('Y-m-d 00:00:00', time() - 3600 * 24 * 7));
        // Только оплаченные, т.е. со статусом "В работе" или "Доставлен"
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->eq('order1.status',':status1'),
            $qb->expr()->eq('order1.status',':status2')
        ))
            ->setParameter('status1', Order::STATUS_PROCESSING)
            ->setParameter('status2', Order::STATUS_DELIVERED);
        /** @var Order[] $orders */
        $orders = $qb->getQuery()->getResult();
        return $this->getOrdersSum($orders);
    }

    /**
     * @return float Сумма заказов за месяц
     */
    public function getOrdersMonthlySum() {
        $qb = $this->createQueryBuilder('order1');
        $qb->andWhere($qb->expr()->gt('order1.added', ':added'))
            ->setParameter('added', date('Y-m-d 00:00:00', time() - 3600 * 24 * 30));
        // Только оплаченные, т.е. со статусом "В работе" или "Доставлен"
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->eq('order1.status',':status1'),
            $qb->expr()->eq('order1.status',':status2')
        ))
            ->setParameter('status1', Order::STATUS_PROCESSING)
            ->setParameter('status2', Order::STATUS_DELIVERED);
        /** @var Order[] $orders */
        $orders = $qb->getQuery()->getResult();
        return $this->getOrdersSum($orders);
    }

    /**
     * @return float Сумма заказов всего
     */
    public function getOrdersTotalSum() {
        $qb = $this->createQueryBuilder('order1');
        // Только оплаченные, т.е. со статусом "В работе" или "Доставлен"
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->eq('order1.status',':status1'),
            $qb->expr()->eq('order1.status',':status2')
        ))
            ->setParameter('status1', Order::STATUS_PROCESSING)
            ->setParameter('status2', Order::STATUS_DELIVERED);
        /** @var Order[] $orders */
        $orders = $qb->getQuery()->getResult();
        return $this->getOrdersSum($orders);
    }

    /**
     * @param Order[] $orders
     * @return float
     */
    private function getOrdersSum($orders) {
        $sum = 0;
        foreach($orders as $order) {
            $sum += $order->getTotalCost();
        }
        return $sum;
    }

}
