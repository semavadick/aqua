<?php

namespace app\repositories;

use app\models\Advantage;
use app\models\Language;

/**
 * Репозиторий преимуществ
 */
class AdvantagesRepository extends Repository {

    /** @return AdvantagesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Advantage'); }

    /**
     * @param Language $language
     * @return Advantage[]
     */
    public function findAdvantagesForAboutPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->getResult();
    }

}
