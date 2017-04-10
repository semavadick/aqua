<?php

namespace back\Services\forms;

use app\models\Entity;
use app\models\Service;
use app\models\ServiceAdvantage;
use app\models\ServiceType;
use back\forms\EntityForm;
use back\validators\FormImageValidator;

abstract class ServiceForm extends EntityForm {
    
    public $bg;

    /** @var Service|null */
    private $service = null;

    /** @var AdvantageForm[] */
    private $advantageForms = [];

    /** @var ServiceAdvantage[] */
    private $advantagesToDelete = [];

    /** @var TypeForm[] */
    private $typeForms = [];

    /** @var ServiceType[] */
    private $typeToDelete = [];

    public function rules() {
        $rules = [];
        if($this->hasBgImage()) {
            $rules[] = [
                'bg', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->service) ? $this->service->getBgPath() : null;
            }];
        }
        return $rules;
    }

    /**
     * @inheritdoc
     * @param Service $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->service = $entity;
        foreach($entity->getAdvantages() as $advantage) {
            $this->advantagesToDelete[$advantage->getId()] = $advantage;
            $form = new AdvantageForm();
            $form->setEntity($advantage);
            $this->advantageForms[] = $form;
        }
        if($this->hasTypes()){
            foreach($entity->getTypes() as $type) {
                $this->typeToDelete[$type->getId()] = $type;
                $form = new TypeForm();
                $form->setEntity($type);
                $this->typeForms[] = $form;
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param Service $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        $data = [
            'bgUrl' => $entity->getSmallBgPath(),
            'advantages' => [

            ],
        ];
        foreach($this->advantageForms as $form) {
            $data['advantages'][] = $form->getData();
        }
        if($this->hasTypes()){
            $data['types'] = [];
            foreach($this->typeForms as $typeForm){
                $data['types'][] = $typeForm->getData();
            }
        }
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function load($data, $formName = '') {
        if(!parent::load($data, $formName)) {
            return false;
        }

        if(empty($data['advantages']) || !is_array($data['advantages'])) {
            return false;
        }
        foreach($data['advantages'] as $advantageData) {
            $advantageForm = null;
            if(!empty($advantageData['id'])) {
                foreach($this->advantageForms as $form) {
                    if($form->id == $advantageData['id']) {
                        $advantageForm = $form;
                        unset($this->advantagesToDelete[$form->id]);
                        break;
                    }
                }
            }
            if(empty($advantageForm)) {
                $advantageForm = new AdvantageForm();
                $this->advantageForms[] = $advantageForm;
            }
            $advantageForm->load($advantageData, '');
        }
        if($this->hasTypes() && !empty($data['types'])) {
            foreach($data['types'] as $typeData) {
                $typeForm = null;
                if(!empty($typeData['id'])) {
                    foreach($this->typeForms as $form) {
                        if($form->id == $typeData['id']) {
                            $typeForm = $form;
                            unset($this->typeToDelete[$form->id]);
                            break;
                        }
                    }
                }
                if(empty($typeForm)) {
                    $typeForm = new TypeForm();
                    $this->typeForms[] = $typeForm;
                }
                $typeForm->load($typeData, '');
            }
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param Service $entity
     */
    protected function fillEntity(Entity $entity) {
        if($this->hasBgImage()) {
            $imageResult = $this->saveImage('bg', '/images/services', $entity->getBgPath(), function($path) use($entity) {
                $entity->setBgPath($path);
            }, $entity::BG_WIDTH, $entity::BG_HEIGHT);
            if(!$imageResult) {
                return false;
            }

            $imageResult = $this->saveImage('bg', '/images/services', $entity->getSmallBgPath(), function($path) use($entity) {
                $entity->setSmallBgPath($path);
            }, $entity::SMALL_BG_WIDTH, $entity::SMALL_BG_HEIGHT);
            if(!$imageResult) {
                return false;
            }
        }

        foreach($this->advantageForms as $advantageForm) {
            $advantage = null;
            if(!empty($advantageForm->id)) {
                foreach($entity->getAdvantages() as $typeAdvantage) {
                    if($typeAdvantage->getId() == $advantageForm->id) {
                        $advantage = $typeAdvantage;
                        break;
                    }
                }
            }
            if(empty($advantage)) {
                $advantage = new ServiceAdvantage();
                $advantage->setService($entity);
            }
            $this->getEntityManager()->persist($advantage);
            $advantageForm->fillEntity($advantage);
        }

        foreach($this->advantagesToDelete as $advantage) {
            $this->getEntityManager()->remove($advantage);
        }

        foreach($this->typeForms as $typeForm) {
            $type = null;
            if(!empty($typeForm->id)) {
                foreach($entity->getTypes() as $entityType) {
                    if($entityType->getId() == $typeForm->id) {
                        $type = $entityType;
                        break;
                    }
                }
            }
            if(empty($type)) {
                $type = new ServiceType();
                $type->setService($entity);
            }
            $this->getEntityManager()->persist($type);
            $typeForm->fillEntity($type);
        }

        foreach($this->typeToDelete as $type) {
            $this->getEntityManager()->remove($type);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function validate($attributeNames = null, $clearErrors = true) {
        $result = parent::validate($attributeNames, $clearErrors);
        if(!$result) {
            return false;
        }
        foreach($this->advantageForms as $advantageForm) {
            if(!$advantageForm->validate()) {
                return false;
            }
        }
        foreach($this->typeForms as $typeForm) {
            if(!$typeForm->validate()) {
                return false;
            }
        }
        return true;
    }


    /**
     * @inheritdoc
     */
    public function getErrors($attribute = null) {
        $errors = parent::getErrors($attribute);
        $errors['advantages'] = [];
        foreach($this->advantageForms as $advantageForm) {
            $errors['advantages'][] = $advantageForm->getErrors(null);
        }
        $errors['types'] = [];
        foreach($this->typeForms as $typeForm) {
            $errors['types'][] = $typeForm->getErrors(null);
        }
        return $errors;
    }

    /**
     * @inheritdoc
     * @return Service
     */
    protected function createNewEntity() {
        return new Service();
    }

    protected abstract function hasBgImage();

    protected abstract function hasTypes();

}