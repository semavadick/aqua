<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с языком
 * @ORM\Entity(repositoryClass="app\repositories\LanguagesRepository")
 */
class Language {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** Id русского языка */
    const ID_RU = 1;

    /** Id английского языка */
    const ID_EN = 2;

    /** Id дефолтного языка */
    const ID_DEFAULT = self::ID_RU;

    private static $codes = [
        self::ID_RU => self::CODE_RU,
        self::ID_EN => self::CODE_EN,
    ];

    /** Id русского языка */
    const CODE_RU = 'ru';

    /** Id английского языка */
    const CODE_EN = 'en';

    /** @ORM\Column(type="string") */
    protected $name = '';

    /** @ORM\Column(type="string") */
    protected $slug = '';

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return string Название */
    public function getName() { return $this->name; }

    /** @param string $name Название */
    public function setName($name) { $this->name = $name; }

    /** @return string */
    public function getCode() { return self::$codes[$this->id]; }

    /** @return string */
    public function getLabelForSwitcher() {
        $labels = [
            self::ID_RU => 'RU',
            self::ID_EN => 'ENG',
        ];
        return $labels[$this->id];
    }

    public function getSlug() { return $this->slug; }

    public function setSlug($slug) { $this->slug = $slug; }

    public static function getCurrentLanguage(){
        $lang = LanguagesRepository::getInstance()->findLanguageByCode(\Yii::$app->language);
        if(empty($lang)) {
            $lang = LanguagesRepository::getInstance()->findLanguageById(self::ID_DEFAULT);
        }
        return $lang;
    }

}