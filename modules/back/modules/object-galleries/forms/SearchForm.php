<?php

namespace back\ObjectGalleries\forms;

use app\components\Doctrine;
use app\models\Entity;
use Doctrine\ORM\EntityRepository;

class SearchForm extends \back\forms\SearchForm{

    private $sortAttrs = [
        'id',
    ];

    /** @return Entity[] Найденные сущности */
    public function findEntities() {
        $qb = $this->getRepository()->createQueryBuilder('n');
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
        $qb = $this->getRepository()->createQueryBuilder('n');
        $qb->select($qb->expr()->count('n.id'));
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

    /** @return EntityRepository */
    protected function getRepository() {
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        return $doctrine->getEntityManager()->getRepository('Models:ObjectGallery');
    }

}