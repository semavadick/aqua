<?php

namespace app\repositories;

use app\models\FaqItem;
use app\models\Language;

/**
 * Репозиторий вопросов faq
 */
class FaqItemsRepository extends Repository {

    /** @return FaqItemsRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:FaqItem'); }

    /**
     * @param Language $language
     * @return FaqItem[]
     */
    public function findItemsForBuildingPage(Language $language) {
        $qb = $this->createQueryBuilder('s');
        $this->addLanguageCondition($qb, 's', $language);
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Language $language
     * @param string $text
     * @param int $limit
     * @return FaqItem[]
     */
    public function findItemsByText(Language $language, $text, $limit) {
        $qb = $this->createQueryBuilder('s');
        $qb->innerJoin("s.i18ns", 'i18ns')
            ->where($qb->expr()->eq('i18ns.languageId', ':languageId'))
            ->setParameter('languageId', $language->getId())

            ->andWhere($qb->expr()->orX(
                $qb->expr()->like('i18ns.question', ':text'),
                $qb->expr()->like('i18ns.answer', ':text')
            ))
            ->setParameter('text', "%{$text}%");

        return $qb->getQuery()->setMaxResults($limit)->getResult();
    }

}
