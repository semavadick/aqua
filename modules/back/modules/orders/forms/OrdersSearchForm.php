<?php

namespace back\Orders\forms;

use app\components\Doctrine;
use back\forms\SearchForm;

class OrdersSearchForm extends SearchForm {

    public $id;
    public $status;
    public $clientId;

    private $sortAttrs = [
        'id', 'added',
    ];
    
    public function rules() {
        return [
            [['id', 'status', 'clientId'], 'safe']
        ];
    }

    private function createQueryBuilder() {
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        $qb = $doctrine->getEntityManager()->getRepository('Models:Order')->createQueryBuilder('order1');
        if(!empty($this->id)) {
            $qb->andWhere($qb->expr()->eq('order1.id', ':id'))
                ->setParameter('id', $this->id);
        }
        if(is_numeric($this->status)) {
            $qb->andWhere($qb->expr()->eq('order1.status', ':status'))
                ->setParameter('status', $this->status);
        }
        if(!empty($this->clientId)) {
            $qb->andWhere($qb->expr()->eq('order1.userId', ':userId'))
                ->setParameter('userId', $this->clientId);
        }
        return $qb;
    }

    /** @inheritdoc */
    public function findEntities() {
        $qb = $this->createQueryBuilder();
        if($this->sortAttribute && in_array($this->sortAttribute, $this->sortAttrs)) {
            $direction = $this->sortDirection == self::SORT_DESC ? 'DESC' : 'ASC';
            $qb->orderBy('order1.' . $this->sortAttribute, $direction);
        }

        $query = $qb->getQuery();
        if($this->limit > 0) {
            $query->setMaxResults($this->limit);
        }
        if($this->offset > 0) {
            $query->setFirstResult($this->offset);
        }

        return $query->getResult();
    }

    /** @inheritdoc */
    public function getTotalEntitiesCount() {
        $qb = $this->createQueryBuilder();
        $qb->select($qb->expr()->count('order1.id'));
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

}