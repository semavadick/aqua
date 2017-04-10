<?php

namespace app\repositories;

use app\models\ObjectGallery;
use app\models\Language;

/**
 * Репозиторий галерей объектов
 */
class ObjectGalleriesRepository extends Repository {

    /** @return ObjectGalleriesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:ObjectGallery'); }

    /**
     * @param Language $language
     * @return ObjectGallery[]
     */
    public function findGalleriesForBuildingPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        $qb->andWhere($qb->expr()->eq('s.isTop', ':isTop'))
            ->setParameter('isTop', true);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $slug
     * @param Language $language
     * @return ObjectGallery|null
     */
    public function findGalleryBySlugAndLanguage($slug, Language $language) {
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
     * @return ObjectGallery[]
     */
    public function findExclusiveGalleries(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        $qb->andWhere($qb->expr()->eq('s.isExclusive', ':isExclusive'))
            ->setParameter('isExclusive', true);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Language $language
     * @param string $text
     * @param int $limit
     * @return ObjectGallery[]
     */
    public function findGalleriesByText(Language $language, $text, $limit) {
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
