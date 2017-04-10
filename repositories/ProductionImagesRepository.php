<?php

namespace app\repositories;

use app\models\ProductionImage;
use app\models\Language;

/**
 * Репозиторий этапов баннеров производства
 */
class ProductionImagesRepository extends Repository {

    /** @return ProductionImagesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:ProductionImage'); }

    /**
     * @param int $count
     * @param Language $language
     * @return ProductionImage[]
     */
    public function findImagesForAboutPage($count, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        $query = $qb->getQuery();
        if($count) {
            $query->setMaxResults($count);
        }
        return $query->getResult();
    }

}
