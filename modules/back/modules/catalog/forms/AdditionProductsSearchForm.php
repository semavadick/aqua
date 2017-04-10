<?php

namespace back\Catalog\forms;

use app\models\Entity;
use app\repositories\AdditionProductsRepository;
use back\forms\SearchForm;

class AdditionProductsSearchForm extends SearchForm {

    public $id;
    public $sku;
    public $name;
    public $categoryId;

    public $sortAttribute = 'sort';

    private $sortAttrs = [
        'sort', 'sku', 'price',
    ];

    public function rules() {
        return [
            [['id', 'sku', 'name', 'categoryId'], 'safe']
        ];
    }

    private function createQueryBuilder() {
        $qb = AdditionProductsRepository::getInstance()->createQueryBuilder('p');
        if(!empty($this->id)) {
            $qb->andWhere($qb->expr()->eq('p.id', ':id'))
                ->setParameter('id', $this->id);
        }
        if(!empty($this->categoryId)) {
            $qb->andWhere($qb->expr()->eq('p.categoryId', ':categoryId'))
                ->setParameter('categoryId', $this->categoryId);
        }

        if(!empty($this->name)) {
            $qb->innerJoin('p.i18ns', 'i18ns')
                ->andWhere($qb->expr()->like('i18ns.name', ':name'))
                ->setParameter('name', '%' . $this->name . '%');
        }
        if(!empty($this->sku)) {
            $qb->andWhere($qb->expr()->like('p.sku', ':sku'))
                ->setParameter('sku', '%' . $this->sku . '%');
        }
        return $qb;
    }

    /** @return Entity[] Найденные сущности */
    public function findEntities() {
        $qb = $this->createQueryBuilder();
        if($this->sortAttribute && in_array($this->sortAttribute, $this->sortAttrs)) {
            $direction = $this->sortDirection == self::SORT_DESC ? 'DESC' : 'ASC';
            $qb->orderBy('p.' . $this->sortAttribute, $direction);
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

    /** @return int Общее кол-во сущностей */
    public function getTotalEntitiesCount() {
        $qb = $this->createQueryBuilder();
        $qb->select($qb->expr()->count('p.id'));
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

}