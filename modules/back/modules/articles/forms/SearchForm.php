<?php

namespace back\Articles\forms;

use app\components\Doctrine;
use Doctrine\ORM\EntityRepository;

class SearchForm extends \back\Publications\forms\SearchForm {

    /** @return EntityRepository */
    protected function getRepository() {
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        return $doctrine->getEntityManager()->getRepository('Models:Article');
    }

}