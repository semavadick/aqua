<?php

namespace back\Users\forms;

use app\repositories\UsersRepository;
use back\forms\SearchForm;

class UsersSearchForm extends SearchForm {
    
    public $id;
    public $email;
    public $phone;
    public $companyName;

    private $sortAttrs = [
        'id',
    ];
    
    public function rules() {
        return [
            [['id', 'email', 'phone', 'companyName'], 'safe']
        ];
    }

    private function createQueryBuilder() {
        $qb = UsersRepository::getInstance()->createQueryBuilder('u');
        if(!empty($this->id)) {
            $qb->andWhere($qb->expr()->eq('u.id', ':id'))
                ->setParameter('id', $this->id);
        }
        if(!empty($this->email)) {
            $qb->andWhere($qb->expr()->like('u.email', ':email'))
                ->setParameter('email', '%' . $this->email . '%');
        }
        if(!empty($this->phone)) {
            $qb->andWhere($qb->expr()->like('u.phone', ':phone'))
                ->setParameter('phone', '%' . $this->phone . '%');
        }
        if(!empty($this->companyName)) {
            $qb->andWhere($qb->expr()->like('u.companyName', ':companyName'))
                ->setParameter('companyName', '%' . $this->companyName . '%');
        }
        return $qb;
    }
    
    /** @inheritdoc */
    public function findEntities() {
        $qb = $this->createQueryBuilder();
        if($this->sortAttribute && in_array($this->sortAttribute, $this->sortAttrs)) {
            $direction = $this->sortDirection == self::SORT_DESC ? 'DESC' : 'ASC';
            $qb->orderBy('u.' . $this->sortAttribute, $direction);
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
        $qb->select($qb->expr()->count('u.id'));
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

}