<?php

namespace back\validators;

use yii\validators\Validator;

class FormImageValidator extends Validator {

    public $required = true;
    public $skipOnEmpty = false;
    /** @var callable */
    public $getCurrentImagePath = null;

    public function validateAttribute($model, $attribute) {
        if(!is_callable($this->getCurrentImagePath)) {
            throw new \Exception('Необходимо указать коллбэк для получения текущего изображения');
        }
        if(!$this->required) {
            return;
        }
        $cb = $this->getCurrentImagePath;
        $currentImage = $cb($attribute);
        $value = $model->$attribute;
        if(empty($value) && empty($currentImage)) {
            $model->addError($attribute, 'Выберите изображение');
        }
    }

}