<?php

namespace back\PoolsBuilding\forms;

use app\models\Entity;
use app\models\PoolType;
use app\models\TypeAdvantage;
use back\PoolsBuilding\forms\TypeAdvantageForm;
use back\forms\EntityForm;
use back\validators\FormImageValidator;

class PoolTypeForm extends EntityForm {

    public $bg;
    public $preview;
    public $widePreview;

    /** @var PoolType|null */
    private $type = null;

    /** @var TypeAdvantageForm[] */
    private $advantageForms = [];

    /** @var TypeAdvantage[] */
    private $advantagesToDelete = [];

    public function rules() {
        return [
            [['preview', 'widePreview'], 'safe'],
            ['bg', FormImageValidator::className(), 'getCurrentImagePath' => function($attribute) {
                return !empty($this->type) ? $this->type->getBgPath() : null;
            }],
        ];
    }

    /**
     * @inheritdoc
     * @param PoolType $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->type = $entity;
        foreach($entity->getAdvantages() as $advantage) {
            $this->advantagesToDelete[$advantage->getId()] = $advantage;
            $form = new TypeAdvantageForm();
            $form->setEntity($advantage);
            $this->advantageForms[] = $form;
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param PoolType $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        $data = [
            'previewUrl' => $entity->getPreviewPath(),
            'widePreviewUrl' => $entity->getWidePreviewPath(),
            'bgUrl' => $entity->getSmallBgPath(),
            'advantages' => [

            ],
        ];
        foreach($this->advantageForms as $form) {
            $data['advantages'][] = $form->getData();
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
                $advantageForm = new TypeAdvantageForm();
                $this->advantageForms[] = $advantageForm;
            }
            $advantageForm->load($advantageData, '');
        }
        return true;
    }

    /**
     * @inheritdoc
     * @param PoolType $entity
     */
    protected function fillEntity(Entity $entity) {
        $imagesDir = '/images/pool-types';

        $imageResult = $this->saveImage('bg', $imagesDir, $entity->getBgPath(), function($path) use($entity) {
            $entity->setBgPath($path);
        }, $entity::BG_WIDTH, $entity::BG_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        $imageResult = $this->saveImage('bg', $imagesDir, $entity->getSmallBgPath(), function($path) use($entity) {
            $entity->setSmallBgPath($path);
        }, $entity::SMALL_BG_WIDTH, $entity::SMALL_BG_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        $imageResult = $this->saveImage('preview', $imagesDir, $entity->getPreviewPath(), function($path) use($entity) {
            $entity->setPreviewPath($path);
        }, $entity::PREVIEW_WIDTH, $entity::PREVIEW_HEIGHT);
        if(!$imageResult) {
            return false;
        }

        $imageResult = $this->saveImage('widePreview', $imagesDir, $entity->getWidePreviewPath(), function($path) use($entity) {
            $entity->setWidePreviewPath($path);
        }, $entity::WIDE_PREVIEW_WIDTH, $entity::WIDE_PREVIEW_HEIGHT);
        if(!$imageResult) {
            return false;
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
                $advantage = new TypeAdvantage();
                $advantage->setType($entity);
            }
            $this->getEntityManager()->persist($advantage);
            $advantageForm->fillEntity($advantage);
        }

        foreach($this->advantagesToDelete as $advantage) {
            $this->getEntityManager()->remove($advantage);
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
        return $errors;
    }

    /**
     * @inheritdoc
     * @return PoolType
     */
    protected function createNewEntity() {
        return new PoolType();
    }

    /**
     * @inheritdoc
     * @return PoolTypeI18nForm
     */
    protected function createNewI18nForm() {
        return new PoolTypeI18nForm();
    }
}