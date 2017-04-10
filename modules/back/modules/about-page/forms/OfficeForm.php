<?php

namespace back\AboutPage\forms;

use app\components\Doctrine;
use app\models\Entity;
use app\models\Office;
use app\models\OfficeRegion;
use back\forms\EntityForm;

class OfficeForm extends EntityForm {

    public $regionId = null;
    public $phone = '';
    public $coordsLat = 0;
    public $coordsLng = 0;

    public function rules() {
        $rules = [
            ['regionId', 'checkRegion', 'skipOnEmpty' => false],
            [['phone', 'coordsLat', 'coordsLng'], 'required', 'message' => 'Заполните поле'],
            ['coordsLat', 'number', 'min' => -90, 'max' => 90],
            ['coordsLng', 'number', 'min' => -180, 'max' => 180],
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function attributeLabels() {
        return [
            'coordsLat' => 'Широта',
            'coordsLng' => 'Долгота',
        ];
    }

    public function checkRegion($attribute, $params) {
        if(empty($this->regionId)) {
            $this->addError($attribute, 'Укажите регион');
            return;
        }
        $region = $this->getRegion();
        if(empty($region)) {
            $this->addError($attribute, 'Укажете корректный регион');
        }
    }

    /** @return OfficeRegion|null */
    private function getRegion() {
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        return $doctrine->getEntityManager()->find('Models:OfficeRegion', $this->regionId);
    }

    /**
     * @inheritdoc
     * @param Office $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $region = $entity->getRegion();
        $this->regionId = !empty($region) ? $region->getId() : null;
        $this->phone = $entity->getPhone();
        $this->coordsLat = $entity->getCoordsLat();
        $this->coordsLng = $entity->getCoordsLng();
        return true;
    }

    /**
     * @inheritdoc
     * @param Office $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setRegion($this->getRegion());
        $entity->setPhone($this->phone);
        $entity->setCoordsLat($this->coordsLat);
        $entity->setCoordsLng($this->coordsLng);
        return true;
    }

    /**
     * @inheritdoc
     * @return Office
     */
    protected function createNewEntity() {
        return new Office();
    }

    /**
     * @inheritdoc
     * @return OfficeI18nForm
     */
    protected function createNewI18nForm() {
        return new OfficeI18nForm();
    }

    /**
     * @inheritdoc
     * @param Office $entity
     */
    public function getRegionsData() {
        /** @var Doctrine $doctrine */
        $doctrine = \Yii::$app->get('doctrine');
        /** @var OfficeRegion[] $regions */
        $regions = $doctrine->getEntityManager()->getRepository('Models:OfficeRegion')->findAll();
        $regionsData = [];
        foreach($regions as $region) {
            $regionsData[] = [
                'id' => $region->getId(),
                'name' => $region->getName(),
            ];
        }
        return $regionsData;
    }

}