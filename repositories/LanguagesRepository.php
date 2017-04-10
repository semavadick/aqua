<?php

namespace app\repositories;

use app\models\Language;

/**
 * Репозиторий языков
 */
class LanguagesRepository extends Repository {

    /** @return LanguagesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Language'); }

    /**
     * @param int $id Id
     * @return null|Language Язык
     */
    public function findLanguageById($id) {
        return $this->find(intval($id));
    }

    /**
     * @param string $code
     * @return null|Language Язык
     */
    public function findLanguageByCode($code) {
        /** @var Language[] $languages */
        $languages = $this->findAll();
        foreach($languages as $language) {
            if($language->getCode() == $code) {
                return $language;
            }
        }
        return null;
    }

    /**
     * @param Language $language Язык
     * @return bool Результат операции
     */
    public function saveLanguage(Language $language) {
        return $this->saveEntity($language);
    }

}
