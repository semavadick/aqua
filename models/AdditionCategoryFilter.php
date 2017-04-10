<?php

namespace app\models;

use app\repositories\LanguagesRepository;
use back\helpers\MagicImage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с фильтром категории
 * @ORM\Entity()
 */
class AdditionCategoryFilter extends Entity {

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
     * @ORM\ManyToOne(targetEntity="app\models\AdditionCategory", inversedBy="filters")
     * @ORM\JoinColumn(name="categoryId", referencedColumnName="id")
     */
    protected $AdditionCategory;

    /**
     * @ORM\OneToMany(targetEntity="app\models\AdditionCategoryFilterI18n", mappedBy="filter")
     */
    protected $i18ns;

    public function __construct() {
        $this->i18ns = new ArrayCollection();
    }

    /** @return int Id */
    public function getId() { return $this->id; }

    /** @return AdditionCategoryFilterI18n[] */
    public function getI18ns() { return $this->i18ns; }

    /** @return AdditionCategory */
    public function getAdditionCategory() { return $this->AdditionCategory; }

    /** @param AdditionCategory $AdditionCategory */
    public function setAdditionCategory($AdditionCategory) { $this->AdditionCategory = $AdditionCategory; }

    public function getText() {
        /** @var AdditionCategoryFilterI18n|null $i18n */
        $i18n = $this->getDefaultI18n();
        if(empty($i18n)) {
            return null;
        }
        return $i18n->getText();
    }

}