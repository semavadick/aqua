<?php

namespace app\repositories;

use app\models\PoolsBuildingStatic;

/**
 * Репозиторий статических страниц Строительства бассейнов
 */
class PoolsBuildingStaticRepository extends Repository {

    /** @return ServicesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:PoolsBuildingStatic'); }

    /**
     * @return PoolsBuildingStatic
     */
    public function findRebuildingPoolsBuildingStatic() {
        return $this->find(PoolsBuildingStatic::REBUILDING_ID);
    }
}
