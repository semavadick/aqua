<?php

namespace app\repositories;

use app\models\OfficeRegion;
use app\models\Language;

/**
 * Репозиторий регионов офисов
 */
class OfficeRegionsRepository extends Repository {

    /** @return OfficeRegionsRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:OfficeRegion'); }

    /**
     * @param Language $language
     * @return OfficeRegion[]
     */
    public function findRegionsForAboutPage(Language $language) {
        return $this->findRegionsForAddressesPage($language);
    }

    /**
     * @param Language $language
     * @return OfficeRegion[]
     */
    public function findRegionsForAddressesPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->getResult();
    }

}
