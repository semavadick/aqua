<?php

namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Базовый класс i18n
 */
abstract class I18n {

    /**
     * @ORM\Id()
     * @ORM\Column()
     */
    protected $languageId;

    /** @return Language */
    public abstract function getLanguage();

    public abstract function setLanguage(Language $language);

}