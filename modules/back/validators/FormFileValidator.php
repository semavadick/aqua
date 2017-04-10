<?php

namespace back\validators;

use back\helpers\HandyFile;
use yii\validators\Validator;

class FormFileValidator extends Validator {

    public $required = true;
    public $skipOnEmpty = false;
    /** @var callable */
    public $getCurrentFilePath = null;
    public $allowedTypes = [
        'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'csv', 'pdf',
        'jpg', 'jpeg', 'png', 'gif',
    ];
    public $maxSize = 1024 * 1024 * 20; // 20 MB

    public function validateAttribute($model, $attribute) {
        if(!is_callable($this->getCurrentFilePath)) {
            throw new \Exception('Необходимо указать коллбэк для получения текущего файла');
        }
        $cb = $this->getCurrentFilePath;
        $currentFile = $cb($attribute);
        /** @var HandyFile $file */
        $file = $model->$attribute;
        if($this->required && empty($file) && empty($currentFile)) {
            $model->addError($attribute, 'Выберите файл');
            return;
        }
        if(empty($file)) {
            return;
        }
        if($file->getSize() > $this->maxSize) {
            $model->addError($attribute, 'Слишком большой файл');
            return;
        }
        if(!in_array($file->getExtension(), $this->allowedTypes)) {
            $model->addError($attribute, 'Разрешенные типы файлов: ' . implode(', ', $this->allowedTypes));
            return;
        }
    }

}