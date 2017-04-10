<?php

namespace app\repositories;

use app\models\MainPageBanner;
use app\models\Language;

/**
 * Репозиторий баннеров
 */
class MainPageBannersRepository extends Repository {

    /** @return MainPageBannersRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:MainPageBanner'); }

    /**
     * @param int $count
     * @param Language $language
     * @return MainPageBanner[]
     */
    public function findBannersForMainPage($count, Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->setMaxResults($count)->getResult();
    }

}
