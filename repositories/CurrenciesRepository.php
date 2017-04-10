<?php

namespace app\repositories;
use app\models\Currency;
use app\models\Language;

/**
 * Репозиторий валют
 */
class CurrenciesRepository extends Repository {

    /** @return CurrenciesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Currency'); }

    /**
     * @param Language $language
     * @return Currency
     */
    public function findCurrencyForLanguage(Language $language) {
        $id = $language->getId() == Language::ID_RU ? Currency::ID_RUB : Currency::ID_EURO;
        return $this->find($id);
    }

}