<?php

namespace app\repositories;

use app\components\Doctrine;
use app\models\Language;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class Repository extends EntityRepository {

    /** @return Doctrine */
    protected static function getDoctrine() { return \Yii::$app->get('doctrine'); }

    /**
     * Сохраняет сущность
     * @param mixed $entity Сущность
     * @return bool Результат операции
     */
    protected function saveEntity($entity) {
        $this->_em->persist($entity);
        $this->_em->flush($entity);
        return true;
    }

    protected function addLanguageCondition(QueryBuilder $qb, $alias, Language $language) {
        $qb->innerJoin("{$alias}.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId());
    }

}