<?php

namespace app\repositories;

use app\models\MainPageSlide;
use app\models\Language;

/**
 * Репозиторий слайдов
 */
class MainPageSlidesRepository extends Repository {

    /** @return MainPageSlidesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:MainPageSlide'); }

    /**
     * @param Language $language
     * @return MainPageSlide[]
     */
    public function findSlidesForMainPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->getResult();
    }

}
