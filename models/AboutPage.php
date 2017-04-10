<?php

namespace app\models;

use app\components\Doctrine;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы со страницей О компании
 * @ORM\Entity()
 */
class AboutPage extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $competenceImagePath = '';

    /** @var AboutPageI18n[] */
    protected $i18ns = null;

    /** @return string */
    public function getCompetenceImagePath() { return $this->competenceImagePath; }

    /** @return string */
    public function getCompetenceImageUrl() { return $this->competenceImagePath; }

    /** @param string $competenceImagePath */
    public function setCompetenceImagePath($competenceImagePath) { $this->competenceImagePath = $competenceImagePath; }

    /** @return I18n[] */
    protected function getI18ns() {
        if($this->i18ns === null) {
            /** @var Doctrine $doctrine */
            $doctrine = \Yii::$app->get('doctrine');
            $this->i18ns = $doctrine->getEntityManager()->getRepository('Models:AboutPageI18n')->findAll();
        }
        return $this->i18ns;
    }

}