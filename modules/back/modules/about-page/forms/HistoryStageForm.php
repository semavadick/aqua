<?php

namespace back\AboutPage\forms;

use app\models\Entity;
use app\models\HistoryStage;
use back\forms\EntityForm;
use back\helpers\MagicImage;

class HistoryStageForm extends EntityForm {

    public $year = 1970;
    public $image;

    private $stage = null;

    public function rules() {
        return [
            ['year', 'required', 'message' => 'Укажите год'],
            ['year', 'number', 'integerOnly' => true, 'min' => 0],
            ['image', 'checkImage', 'skipOnEmpty' => false],
        ];
    }

    public function attributeLabels() {
        return [
            'year' => 'Год',
        ];
    }

    public function checkImage($attribute, $params) {
        if(empty($this->image) && empty($this->stage)) {
            $this->addError($attribute, 'Выберите изображение');
        }
    }

    /**
     * @inheritdoc
     * @param HistoryStage $entity
     */
    protected function populateFromEntity(Entity $entity) {
        $this->stage = $entity;
        $this->year = $entity->getYear();
        return true;
    }

    /**
     * @inheritdoc
     * @param HistoryStage $entity
     */
    protected function getDataFromEntity(Entity $entity) {
        return [
            'imageUrl' => $entity->getImageUrl(),
        ];
    }

    /**
     * @inheritdoc
     * @param HistoryStage $entity
     */
    protected function fillEntity(Entity $entity) {
        $entity->setYear($this->year);
        if(empty($this->image)) {
            return true;
        }

        $image = MagicImage::createFromDataUrl($this->image);
        if(empty($image)) {
            $this->addError('image', 'Не удалось загрузить изображение');
            return false;
        }
        $image->resize($entity::IMAGE_WIDTH, $entity::IMAGE_HEIGHT);
        $imagePath = $image->saveToDir('/images/history');
        if(empty($imagePath)) {
            $this->addError('image', 'Не удалось сохранить изображение');
            return false;
        }

        MagicImage::deleteImage($entity->getImagePath());

        $entity->setImagePath($imagePath);

        return true;
    }

    /**
     * @inheritdoc
     * @return HistoryStage
     */
    protected function createNewEntity() {
        return new HistoryStage();
    }

    /**
     * @inheritdoc
     * @return HistoryStageI18nForm
     */
    protected function createNewI18nForm() {
        return new HistoryStageI18nForm();
    }
}