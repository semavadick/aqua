<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с этапом истории
 * @ORM\Entity(repositoryClass="app\repositories\HistoryStagesRepository")
 */
class HistoryStage extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $year = 0;

    /** @ORM\Column(type="string") */
    protected $imagePath = '';

    const IMAGE_WIDTH = 289;
    const IMAGE_HEIGHT = 179;

    /**
     * @ORM\OneToMany(targetEntity="app\models\HistoryStageI18n", mappedBy="stage")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return string Путь до изображения */
    public function getImagePath() { return $this->imagePath; }

    /** @param string $imagePath Путь до изображения */
    public function setImagePath($imagePath) { $this->imagePath = $imagePath; }

    /** @return string Url изображения */
    public function getImageUrl() { return $this->imagePath; }

    /** @return int */
    public function getYear() { return $this->year; }

    /** @param int $year */
    public function setYear($year) { $this->year = $year; }

    /** @return HistoryStageI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return string|null */
    public function getText() {
        $ruLang = LanguagesRepository::getInstance()->findLanguageById(Language::ID_RU);
        /** @var HistoryStageI18n|null $i18n */
        $i18n = $this->getI18n($ruLang);
        if(!empty($i18n)) {
            return $i18n->getText();
        }
        foreach($this->getI18ns() as $i18n) {
            return $i18n->getText();
        }
        return null;
    }

}