<?php

namespace app\models;

use app\components\Doctrine;
use Doctrine\ORM\Mapping as ORM;

/**
 * Класс для работы со страницей Каталог
 * @ORM\Entity()
 */
class CatalogPage extends Entity {

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @var CatalogPageI18n[] */
    protected $i18ns = null;

    /** @return I18n[] */
    protected function getI18ns() {
        if($this->i18ns === null) {
            /** @var Doctrine $doctrine */
            $doctrine = \Yii::$app->get('doctrine');
            $this->i18ns = $doctrine->getEntityManager()->getRepository('Models:CatalogPageI18n')->findAll();
        }
        return $this->i18ns;
    }

}