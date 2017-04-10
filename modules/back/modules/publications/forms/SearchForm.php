<?php

namespace back\Publications\forms;

use app\components\Doctrine;
use app\models\Entity;
use Doctrine\ORM\EntityRepository;

abstract class SearchForm extends \back\forms\SearchForm {

    public $id;
    public $name;

    private $sortAttrs = [
        'id', 'added',
    ];

    public function rules() {
        return [
            [['id', 'name'], 'safe']
        ];
    }

    private function createQueryBuilder() {
        $qb = $this->getRepository()->createQueryBuilder('n');
        if(!empty($this->id)) {
            $qb->andWhere($qb->expr()->eq('n.id', ':id'))
                ->setParameter('id', $this->id);
        }
        if(!empty($this->name)) {
            $qb->innerJoin('n.i18ns', 'i18ns')
                ->andWhere($qb->expr()->like('i18ns.name', ':name'))
                ->setParameter('name', '%' . $this->name . '%');
        }
        return $qb;
    }

    /** @return Entity[] Найденные сущности */
    public function findEntities() {
        $qb = $this->createQueryBuilder();
        if($this->sortAttribute && in_array($this->sortAttribute, $this->sortAttrs)) {
            $direction = $this->sortDirection == self::SORT_DESC ? 'DESC' : 'ASC';
            $qb->orderBy('n.' . $this->sortAttribute, $direction);
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
        $qb->select($qb->expr()->count('n.id'));
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

    /** @return EntityRepository */
    protected abstract function getRepository();

}