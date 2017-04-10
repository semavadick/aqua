<?php

namespace app\repositories;

use app\models\Category;
use app\models\Language;

/**
 * Репозиторий категорий
 */
class CategoriesRepository extends Repository {

    /** @return CategoriesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Category'); }

    /** @return Category[]*/
    public function findFirstLevelCategories() {
        return $this->findBy(['parentId' => null], ['sort' => 'ASC']);
    }

    /**
     * @param string $slug
     * @param Language $language
     * @return Category|null
     */
    public function findCategoryBySlugAndLanguage($slug, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())
            ->andWhere($qb->expr()->eq('i18ns.slug', ':slug'))
            ->setParameter('slug', $slug);
        $qb->orderBy('s.sort','ASC');
        $categories = $qb->getQuery()->getResult();
        return !empty($categories) ? array_shift($categories) : null;
    }

    /**
     * @param Language $language
     * @return Category[]
     */
    public function findFirstLevelCategoriesByLanguage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId());
        $qb->andWhere('s.parentId IS NULL');
        $qb->orderBy('s.sort','ASC');
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Language $language
     * @param string $text
     * @param int $limit
     * @return Category[]
     */
    public function findCategoriesByText(Language $language, $text, $limit) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->where($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())

            ->andWhere($qb->expr()->orX(
                $qb->expr()->like('i18ns.name', ':text'),
                $qb->expr()->like('i18ns.description', ':text')
            ))
            ->setParameter('text', "%{$text}%");

        $qb->orderBy('s.sort','ASC');

        return $qb->getQuery()->setMaxResults($limit)->getResult();
    }

}
