<?php

namespace app\repositories;

use app\models\Article;
use app\models\Category;
use app\models\Language;
use yii\data\Pagination;

/**
 * Репозиторий статей
 */
class ArticlesRepository extends Repository {

    /** @return ArticlesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Article'); }

    /**
     * @param int $limit
     * @return Article[] Последние статьи
     */
    public function findLastArticles($limit) {
        return $this->findBy([], ['added' => 'desc'], $limit);
    }

    /**
     * @param int $count
     * @param Language $language
     * @return Article[]
     */
    public function findArticlesForMainPage($count, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->eq('s.active', ':active'))
            ->setParameter('active', 1);

        $this->addLanguageCondition($qb, 's', $language);
        $qb->orderBy('s.added', 'DESC');
        return $qb->getQuery()->setMaxResults($count)->getResult();
    }

    /**
     * @param int $count
     * @param Language $language
     * @return Article[]
     */
    public function findArticlesForSearchPage($count, Language $language) {
        return $this->findArticlesForMainPage($count, $language);
    }

    /**
     * @param Language $language
     * @param Category $category
     * @return Article|null
     */
    public function findTopArticle(Language $language, Category $category = null) {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->eq('s.active', ':active'))
            ->setParameter('active', 1);

        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId());
        if(!empty($category)) {
            $qb->innerJoin("s.categories", 'categories')
                ->andWhere($qb->expr()->eq('categories.id', ':categoryId'))
                ->setParameter('categoryId', $category->getId());
        }
        $qb->orderBy('s.added', 'DESC');
        $articles = $qb->getQuery()->setMaxResults(1)->getResult();
        return !empty($articles) ? array_shift($articles) : null;
    }

    /**
     * @param string $slug
     * @param Language $language
     * @return Article|null
     */
    public function findArticleBySlugAndLanguage($slug, Language $language) {
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
     * @param Category|null $category
     * @param Article|null $exArticle
     * @param Pagination $pagination
     * @return Article[]
     */
    public function findArticlesForKnowledgePage(Language $language, Category $category = null, Article $exArticle = null, Pagination $pagination) {
        $qb = $this->createQueryBuilder('s');
        $qb->andWhere($qb->expr()->eq('s.active', ':active'))
            ->setParameter('active', 1);

        $qb->orderBy('s.added', 'DESC');

        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId());

        if(!empty($category)) {
            $qb->innerJoin("s.categories", 'categories')
                ->andWhere($qb->expr()->eq('categories.id', ':categoryId'))
                ->setParameter('categoryId', $category->getId());
        }

        if(!empty($exArticle)) {
            $qb->andWhere($qb->expr()->neq('s.id', ':exId'))
                ->setParameter('exId', $exArticle->getId());
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
     * @return Article[]
     */
    public function findArticlesByText(Language $language, $text, $limit) {
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
