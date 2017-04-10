<?php

namespace app\repositories;

use app\models\TechAdvantage;
use app\models\Language;

/**
 * Репозиторий преимуществ технологии
 */
class TechAdvantagesRepository extends Repository {

    /** @return TechAdvantagesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:TechAdvantage'); }

    /**
     * @param Language $language
     * @return TechAdvantage[]
     */
    public function findAdvantagesForBuildingPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Language $language
     * @param string $text
     * @param int $limit
     * @return TechAdvantage[]
     */
    public function findAdvantagesByText(Language $language, $text, $limit) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->where($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())

            ->andWhere($qb->expr()->orX(
                $qb->expr()->like('i18ns.tagline', ':text'),
                $qb->expr()->like('i18ns.text', ':text')
            ))
            ->setParameter('text', "%{$text}%");

        return $qb->getQuery()->setMaxResults($limit)->getResult();
    }

}
