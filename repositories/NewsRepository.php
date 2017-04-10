<?php

namespace app\repositories;

use app\models\Language;
use app\models\News;
use yii\data\Pagination;

/**
 * Репозиторий новостей
 */
class NewsRepository extends Repository {

    /** @return NewsRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:News'); }

    /**
     * @param int $limit
     * @return News[] Последние новости
     */
    public function findLastNews($limit) {
        return $this->findBy([], ['added' => 'desc'], $limit);
    }

    /**
     * @param int $count
     * @param Language $language
     * @return News[]
     */
    public function findNewsForMainPage($count, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->eq('s.active', ':active'))
            ->setParameter('active', 1);

        $qb->orderBy('s.added', 'DESC');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->setMaxResults($count)->getResult();
    }

    /**
     * @param int $count
     * @param Language $language
     * @return News[]
     */
    public function findNewsForAboutPage($count, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->eq('s.active', ':active'))
            ->setParameter('active', 1);

        $qb->orderBy('s.added', 'DESC');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->setMaxResults($count)->getResult();
    }

    /**
     * @param Language $language
     * @return News|null
     */
    public function findTopNewsItem(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->eq('s.active', ':active'))
            ->setParameter('active', 1);

        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId());
        $qb->orderBy('s.added', 'DESC');
        $articles = $qb->getQuery()->setMaxResults(1)->getResult();
        return !empty($articles) ? array_shift($articles) : null;
    }

    /**
     * @param string $slug
     * @param Language $language
     * @return News|null
     */
    public function findNewsItemBySlugAndLanguage($slug, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())
            ->andWhere($qb->expr()->eq('i18ns.slug', ':slug'))
            ->setParameter('slug', $slug);
        $qb->orderBy('s.added', 'DESC');
        $articles = $qb->getQuery()->getResult();
        return !empty($articles) ? array_shift($articles) : null;
    }

    /**
     * @param Language $language
     * @param News|null $exNewsItem
     * @param Pagination $pagination
     * @return News[]
     */
    public function findNewsForNewsPage(Language $language, News $exNewsItem = null, Pagination $pagination) {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->eq('s.active', ':active'))
            ->setParameter('active', 1);

        $qb->orderBy('s.added', 'DESC');

        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId());

        if(!empty($exNewsItem)) {
            $qb->andWhere($qb->expr()->neq('s.id', ':exId'))
                ->setParameter('exId', $exNewsItem->getId());
        }

        $query = $qb->getQuery();

        $qb->select($qb->expr()->count('s.id'));
        $pagination->totalCount = intval($qb->getQuery()->getSingleScalarResult());

        $query
            ->setMaxResults($pagination->getLimit())
            ->setFirstResult($pagination->getOffset());

        return $query->getResult();
    }

    /**
     * @param Language $language
     * @param string $text
     * @param int $limit
     * @return News[]
     */
    public function findNewsByText(Language $language, $text, $limit) {
        $qb = $this->createQueryBuilder('s');
        $qb->join("s.i18ns", 'i18ns');
        $qb->where($qb->expr()->eq('s.active', ':active'));
        $qb->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'));
        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->like('i18ns.name', ':text'),
            $qb->expr()->like('i18ns.description', ':text')
        ));
        $qb->setParameters(array(
            'active' => 1,
            'languageId' => $language->getId(),
            'text' => "%{$text}%"
        ));

        return $qb->getQuery()->setMaxResults($limit)->getResult();
    }

}
