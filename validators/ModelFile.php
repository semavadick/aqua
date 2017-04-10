<?php

namespace app\validators;

use back\helpers\HandyFile;
use yii\base\Model;
use yii\validators\Validator;
use yii\validators\ValidationAsset;
use Yii;

/**
 * Валидатор для файлов модели
 */
class ModelFile extends Validator {

    /**
     * @inheritdoc
     */
    public $skipOnEmpty = false;

    /** @var bool */
    public $required = false;

    /** @var array */
    public $types = [
        'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'csv', 'pdf',
        'jpg', 'jpeg', 'png', 'gif',
    ];

    /** @var int */
    public $maxSize = 1024 * 1024 * 20; // 20 MB

    /**
     * @inheritdoc
     * @param Model $model
     */
    public function validateAttribute($model, $attribute) {
        /** @var HandyFile|null $file */
        $file = $model->$attribute;
        if($this->required && empty($file)) {
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
        if(!in_array($file->getExtension(), $this->types)) {
            $model->addError($attribute, 'Разрешенные типы файлов: ' . implode(', ', $this->types));
            return;
        }
    }

    /**
     * @inheritdoc
     * @param Model $model
     */
    public function clientValidateAttribute($model, $attribute, $view) {
        $validation = '';

        if($this->required) {
            $options = [
                'message' => 'Укажите файл',
            ];
            ValidationAsset::register($view);
            $validation .= 'yii.validation.required(value, messages, ' . json_encode($options, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . ');';
        }

        $validation .= '
            if(value && value.length) {
                var extensions = ' . json_encode($this->types) . ';
                var ext = value.split(".").pop().toLowerCase();
                if(extensions.indexOf(ext) < 0) {
                    messages.push("Разрешенные типы файлов: " + extensions.join(", "));
                }
            }
        ';

        return $validation;
    }

} 