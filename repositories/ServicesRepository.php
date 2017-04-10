<?php

namespace app\repositories;

use app\models\Service;

/**
 * Репозиторий услуг
 */
class ServicesRepository extends Repository {

    /** @return ServicesRepository Репозиторий */
    public static function getInstance() { return self::getDoctrine()->getEntityManager()->getRepository('Models:Service'); }

    /**
     * @return Service
     */
    public function findMaintenanceService() {
        return $this->find(Service::MAINTENANCE_ID);
    }

    /**
     * @return Service
     */
    public function findExclusiveService() {
        return $this->find(Service::EXCLUSIVE_ID);
    }

}
