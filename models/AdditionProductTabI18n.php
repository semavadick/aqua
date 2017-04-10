<?php

namespace app\models;

use app\components\Doctrine;
use app\helpers\SlugHelper;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с локализацией информационной вкладкой товара
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class AdditionProductTabI18n extends I18n {

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\AdditionProductTab", inversedBy="i18ns")
     * @ORM\JoinColumn(name="tabId", referencedColumnName="id")
     */
    protected $tab;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="app\models\Language")
     * @ORM\JoinColumn(name="languageId", referencedColumnName="id")
     */
    protected $language;

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @ORM\Column(type="text") */
    protected $content = '';

    /** @return Language */
    public function getLanguage() { return $this->language; }

    /** @param Language $language */
    public function setLanguage(Language $language) { $this->languageId = $language->getId(); $this->language = $language; }

    /** @return AdditionProductTab */
    public function getTab() { return $this->tab; }

    /** @param AdditionProductTab $tab */
    public function setTab($tab) { $this->tab = $tab; }

    /** @return string */
    public function getName() { return $this->name; }

    /** @param string $name */
    public function setName($name) { $this->name = $name; }

    /** @return string */
    public function getContent() { return $this->content; }

    /** @param string $content */
    public function setContent($content) { $this->content = $content; }
}