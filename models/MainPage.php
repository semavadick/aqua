<?php

namespace app\models;

use app\components\Doctrine;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы с главной страницей
 * @ORM\Entity()
 */
class MainPage extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @var MainPageI18n[] */
    protected $i18ns = null;

    /** @return MainPageI18n[] */
    protected function getI18ns() {
        if($this->i18ns === null) {
            /** @var Doctrine $doctrine */
            $doctrine = \Yii::$app->get('doctrine');
            $this->i18ns = $doctrine->getEntityManager()->getRepository('Models:MainPageI18n')->findAll();
        }
        return $this->i18ns;
    }

}