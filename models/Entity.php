<?php

namespace app\models;
use app\repositories\LanguagesRepository;

/**
 * Базовый класс сущности
 */
abstract class Entity {

    /**
     * @param Language $language Язык
     * @return I18n|null Лоализация
     */
    public function getI18n(Language $language) {
        foreach($this->getI18ns() as $i18n) {
            if($i18n->getLanguage()->getId() == $language->getId()) {
                return $i18n;
            }
        }
        return null;
    }

    /** @return I18n[] */
    protected abstract function getI18ns();

    protected function getDefaultI18n() {
        $ruLang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        /** @var I18n|null $i18n */
        $i18n = $this->getI18n($ruLang);
        if(!empty($i18n)) {
            return $i18n;
        }
        foreach($this->getI18ns() as $i18n) {
            return $i18n;
        }
        return null;
    }

}