<?php

namespace app\repositories;

use app\models\Article;
use app\models\AdditionCategory;
use app\models\AdditionCategoryFilter;
use app\models\Language;
use app\models\AdditionProduct;
use yii\data\Pagination;


/**
 * Репозиторий товаров
 */
class AdditionProductsRepository extends Repository {

    /** @return ProductsRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:AdditionProduct'); }

    /**
     * @param int $count
     * @param Language $language
     * @param AdditionCategory|null $activeCategory
     * @return AdditionProduct[]
     */
    public function findProductsForKnowledgePage($count, Language $language, AdditionCategory $activeCategory = null) {
        $products = [];

        // By categories
        if(!empty($activeCategory)) {
            $categories = $activeCategory->getChildren();
            $categories[] = $activeCategory;
            $products = $this->findRelatedProductsByCategories($language, $categories, $count);
        }

        return $products;
    }

    /**
     * @param int $count
     * @param Language $language
     * @param Article $article
     * @return AdditionProduct[]
     */
    public function findProductsForArticlePage($count, Language $language, Article $article) {

        // By categories
        $categories = [];
        foreach($article->getCategories() as $category) {
            $categories[] = $category;
            $categories = array_merge($categories, $category->getChildren());
        }
        $products = $this->findRelatedProductsByCategories($language, $categories, $count);

        return $products;
    }

    /**
     * @param Language $language
     * @param AdditionCategory $category
     * @param AdditionCategoryFilter $filter
     * @param Pagination $pagination
     * @return AdditionProduct[]
     */
    public function findProductsForStorePage(Language $language, AdditionCategory $category, AdditionCategoryFilter $filter = null, Pagination $pagination) {
        $qb = $this->createQueryBuilder('s');
        $qb->orderBy('s.id', 'DESC');

        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId());

        $categoriesIds = $category->getChildrenIds();
        $categoriesIds[] = $category->getId();
        $qb->andWhere($qb->expr()->in('s.categoryId', ':categoriesIds'))
            ->setParameter('categoriesIds', $categoriesIds);

        if(!empty($filter)) {
            $qb->innerJoin("s.filters", 'filters')
                ->andWhere($qb->expr()->eq('filters.id', ':filterId'))
                ->setParameter('filterId', $filter->getId());
        }

        $qb->orderBy('s.sort','ASC');
        $query = $qb->getQuery();

        $qb->select($qb->expr()->count('s.id'));
        $pagination->totalCount = intval($qb->getQuery()->getSingleScalarResult());

        $query
            ->setMaxResults($pagination->getLimit())
            ->setFirstResult($pagination->getOffset());

        return $query->getResult();
    }

    /**
     * @param int $count
     * @param Language $language
     * @param AdditionCategory $category
     * @param AdditionCategoryFilter $filter
     * @return AdditionProduct[]
     */
    public function findRelatedProductsForStorePage($count, Language $language, AdditionCategory $category, AdditionCategoryFilter $filter = null) {
        // By related categories
        $products = $this->findRelatedProductsByCategories($language, $category->getAllRelatedCategories(), $count);

        return $products;
    }

    /**
     * @param int $count
     * @param Language $language
     * @param AdditionProduct $product
     * @return AdditionProduct[]
     */
    public function findRelatedProductsForProductPage($count, Language $language, AdditionProduct $product) {
        // Related
        $products = [];
        foreach($product->getRelatedProducts() as $relatedProduct) {
            $i18 = $product->getI18n($language);
            if(!empty($i18)) {
                $products[] = $relatedProduct;
            }
        }

        foreach($product->getRelatedAdditionProducts() as $relatedProduct) {
            $i18 = $product->getI18n($language);
            if(!empty($i18)) {
                $products[] = $relatedProduct;
            }
        }

        // By related categories
        $additCount = $count - count($products);
        if($additCount > 0) {
            $category = $product->getCategory();
            if(!empty($category)) {
                $products = array_merge($products, $this->findRelatedProductsByCategories($language, $category->getAllRelatedCategories(), $additCount));
            }
        }

        return $products;
    }

    /**
     * @param string $slug
     * @param Language $language
     * @return AdditionProduct|null
     */
    public function findProductBySlugAndLanguage($slug, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->andWhere($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())
            ->andWhere($qb->expr()->eq('i18ns.slug', ':slug'))
            ->setParameter('slug', $slug);
        $categories = $qb->getQuery()->getResult();
        return !empty($categories) ? array_shift($categories) : null;
    }

    /**
     * @param int[] $ids
     * @return AdditionProduct[]
     */
    public function findProductsForCart($ids) {
        if(empty($ids)) {
            return [];
        }
        return $this->findBy([
            'id' => $ids,
            'isOnOffer' => true,
        ]);
    }

    /**
     * @param Language $language
     * @param string $text
     * @param int $limit
     * @return AdditionProduct[]
     */
    public function findProductsByText(Language $language, $text, $limit) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->where($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())

            ->andWhere($qb->expr()->orX(
                $qb->expr()->like('s.sku', ':text'),
                $qb->expr()->like('i18ns.name', ':text'),
                $qb->expr()->like('i18ns.description', ':text')
            ))
            ->setParameter('text', "%{$text}%");

        return $qb->getQuery()->setMaxResults($limit)->getResult();
    }

    /**
     * @param Language $language
     * @param AdditionCategory[] $categories
     * @param int $count
     * @return AdditionProduct[]
     */
    private function findRelatedProductsByCategories(Language $language, $categories, $count) {
        $categoriesProducts = [];
        foreach($categories as $category) {
            $qb = $this->createQueryBuilder('s');
            $productsIds = $this->getRandomProductsIdsByCategoryAndLanguage($category, $language, $count);
            if(empty($productsIds)) {
                continue;
            }
            $qb->where($qb->expr()->in("s.id", $productsIds));
            $categoryProducts = $qb->getQuery()->getResult();
            shuffle($categoryProducts);
            $categoriesProducts[] = $categoryProducts;
        }
        shuffle($categoriesProducts);

        $products = [];
        $i = 0;
        while($i < $count) {
            foreach($categoriesProducts as $categoryProducts) {
                if(isset($categoryProducts[$i])) {
                    $products[] = $categoryProducts[$i];
                }
                if(count($products) >= $count) {
                    return $products;
                }
            }
            $i++;
        }

        return $products;
    }

    /**
     * @param AdditionCategory $category
     * @param Language $language
     * @param int $count
     * @return int[]
     */
    private function getRandomProductsIdsByCategoryAndLanguage(AdditionCategory $category, Language $language, $count) {
        $query = "
          SELECT p.id FROM AdditionProduct AS p
            INNER JOIN ProductI18n AS pI18n
              ON p.id = pI18n.productId
          WHERE pI18n.languageId = :languageId
            AND p.categoryId = :categoryId
          ORDER BY RAND()
          LIMIT 0, :prodsCount
        ";
        $cmd = \Yii::$app->getDb()->createCommand($query);
        $cmd->bindValues([
            ':languageId' => $language->getId(),
            ':categoryId' => $category->getId(),
            ':prodsCount' => $count,
        ]);
        $ids = [];
        $rows = $cmd->queryAll();
        foreach($rows as $row) {
            $ids[] = $row['id'];
        }
        return $ids;
    }

}
