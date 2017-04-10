<?php

namespace app\models;

use app\components\Doctrine;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы со страницей Строительство бассейнов
 * @ORM\Entity()
 */
class PoolsBuildingPage extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $projectIconPath = '';

    /** @ORM\Column(type="string") */
    protected $projectImagePath = '';

    /** @ORM\Column(type="string") */
    protected $designIconPath = '';

    /** @ORM\Column(type="string") */
    protected $designImagePath = '';

    /** @ORM\Column(type="string") */
    protected $buildingIconPath = '';

    /** @ORM\Column(type="string") */
    protected $buildingImagePath = '';

    /** @var PoolsBuildingPageI18n[] */
    protected $i18ns = null;

    const MAX_ICON_WIDTH = 100;
    const MAX_ICON_HEIGHT = 100;

    const MAX_IMAGE_WIDTH = 520;
    const MAX_IMAGE_HEIGHT = 410;

    /** @return string */
    public function getId() { return $this->id; }

    /** @return string */
    public function getProjectIconPath() { return $this->projectIconPath; }

    /** @param string $projectIconPath */
    public function setProjectIconPath($projectIconPath) { $this->projectIconPath = $projectIconPath; }

    /** @return string */
    public function getProjectImagePath() { return $this->projectImagePath; }

    /** @param string $projectImagePath */
    public function setProjectImagePath($projectImagePath) { $this->projectImagePath = $projectImagePath; }

    /** @return string */
    public function getDesignIconPath() { return $this->designIconPath; }

    /** @param string $designIconPath */
    public function setDesignIconPath($designIconPath) { $this->designIconPath = $designIconPath; }

    /** @return string */
    public function getDesignImagePath() { return $this->designImagePath; }

    /** @param string $designImagePath */
    public function setDesignImagePath($designImagePath) { $this->designImagePath = $designImagePath; }

    /** @return string */
    public function getBuildingIconPath() { return $this->buildingIconPath; }

    /** @param string $buildingIconPath */
    public function setBuildingIconPath($buildingIconPath) { $this->buildingIconPath = $buildingIconPath; }

    /** @return string */
    public function getBuildingImagePath() { return $this->buildingImagePath; }

    /** @param string $buildingImagePath */
    public function setBuildingImagePath($buildingImagePath) { $this->buildingImagePath = $buildingImagePath; }

    /** @return I18n[] */
    protected function getI18ns() {
        if($this->i18ns === null) {
            /** @var Doctrine $doctrine */
            $doctrine = \Yii::$app->get('doctrine');
            $this->i18ns = $doctrine->getEntityManager()->getRepository('Models:PoolsBuildingPageI18n')->findAll();
        }
        return $this->i18ns;
    }

}