<?php

namespace app\repositories;

use app\models\HistoryStage;
use app\models\Language;

/**
 * Репозиторий этапов истории
 */
class HistoryStagesRepository extends Repository {

    /** @return HistoryStagesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:HistoryStage'); }

    /**
     * @param Language $language
     * @return HistoryStage[]
     */
    public function findStagesForAboutPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        $qb->orderBy('s.year', 'ASC');
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Language $language
     * @param string $text
     * @param int $limit
     * @return HistoryStage[]
     */
    public function findStagesByText(Language $language, $text, $limit) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->where($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())

            ->andWhere($qb->expr()->like('i18ns.text', ':text'))
            ->setParameter('text', "%{$text}%");

        return $qb->getQuery()->setMaxResults($limit)->getResult();
    }

}
