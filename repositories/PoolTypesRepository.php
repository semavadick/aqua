<?php

namespace app\repositories;

use app\models\PoolType;
use app\models\Language;

/**
 * Репозиторий типов бассейнов
 */
class PoolTypesRepository extends Repository {

    /** @return PoolTypesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:PoolType'); }

    /**
     * @param Language $language
     * @return PoolType[]
     */
    public function findPoolTypesForBuildingPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Language $language
     * @return PoolType[]
     */
    public function findPoolTypesForGalleryPage(Language $language) {
        return $this->findPoolTypesForBuildingPage($language);
    }

    /**
     * @param string $slug
     * @param Language $language
     * @return PoolType|null
     */
    public function findTypeBySlugAndLanguage($slug, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())
            ->andWhere($qb->expr()->eq('i18ns.slug', ':slug'))
            ->setParameter('slug', $slug);
        $items = $qb->getQuery()->getResult();
        return !empty($items) ? array_shift($items) : null;
    }

    /**
     * @param Language $language
     * @param string $text
     * @param int $limit
     * @return PoolType[]
     */
    public function findTypesByText(Language $language, $text, $limit) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->where($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())

            ->andWhere($qb->expr()->orX(
                $qb->expr()->like('i18ns.name', ':text'),
                $qb->expr()->like('i18ns.description', ':text')
            ))
            ->setParameter('text', "%{$text}%");

        return $qb->getQuery()->setMaxResults($limit)->getResult();
    }

}
