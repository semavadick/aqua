<?php

namespace back\forms;

use app\components\Doctrine;
use app\models\Entity;
use app\models\Language;
use Doctrine\ORM\EntityManager;
use yii\base\Model;

/**
 * Форма для поиска сущностей
 */
abstract class SearchForm extends Model {

    const SORT_ASC = 0;
    const SORT_DESC = 1;

    public $offset = null;
    public $limit = 10;
    public $sortAttribute = '';
    public $sortDirection = self::SORT_DESC;

    /** @return Entity[] Найденные сущности */
    public abstract function findEntities();

    /** @return int Общее кол-во сущностей */
    public abstract function getTotalEntitiesCount();

}