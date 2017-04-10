<?php

namespace app\repositories;

use app\models\ProductionBanner;
use app\models\Language;

/**
 * Репозиторий этапов баннеров производства
 */
class ProductionBannersRepository extends Repository {

    /** @return ProductionBannersRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:ProductionBanner'); }

    /**
     * @param int $count
     * @param Language $language
     * @return ProductionBanner[]
     */
    public function findBannersForAboutPage($count, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->setMaxResults($count)->getResult();
    }

}
