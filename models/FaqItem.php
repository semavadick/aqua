<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с ответами в
 * @ORM\Entity(repositoryClass="app\repositories\FaqItemsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class FaqItem extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int Id
     */
    protected $id;

    /** @ORM\Column(type="integer") */
    protected $sort = 0;

    /**
     * @ORM\OneToMany(targetEntity="app\models\FaqItemI18n", mappedBy="item")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return FaqItemI18n[] */
    public function getI18ns() { return $this->i18ns; }

    public function getQuestion() {
        $i18n = $this->getDefaultI18n();
        if(!empty($i18n)) {
            return $i18n->getQuestion();
        }
        return null;
    }

    public function getAnswer() {
        $i18n = $this->getDefaultI18n();
        if(!empty($i18n)) {
            return $i18n->getAnswer();
        }
        return null;
    }
}