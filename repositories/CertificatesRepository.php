<?php

namespace app\repositories;

use app\models\Certificate;
use app\models\Language;

/**
 * Репозиторий сертификатов
 */
class CertificatesRepository extends Repository {

    /** @return CertificatesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Certificate'); }

    /**
     * @param Language $language
     * @return Certificate[]
     */
    public function findCertificatesForAboutPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $qb->orderBy('s.sort','ASC');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->getResult();
    }

}
