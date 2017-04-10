<?php

namespace back\forms;

use back\helpers\MagicImage;
use yii\base\Model;

abstract class Form extends Model {

    protected function saveImage($attribute, $dir, $currentImagePath, callable $setImagePath, $width = null, $height = null, $maxWidth = null, $maxHeight = null) {
        $dataUrl = $this->$attribute;
        if(empty($dataUrl)) {
            return true;
        }
        $image = MagicImage::createFromDataUrl($dataUrl);
        if(empty($image)) {
            $this->addError($attribute, 'Не удалось загрузить изображение');
            return false;
        }

        if(!empty($width) && !empty($height)) {
            if(!$image->resize($width, $height)) {
                $this->addError($attribute, 'Не удалось сделать ресайз изображения');
                return false;
            }

        }
        elseif(!empty($maxWidth) && !empty($maxHeight)) {
            if(!$image->resizeToMaxSize($maxWidth, $maxHeight)) {
                $this->addError($attribute, 'Не удалось сделать ресайз изображения');
                return false;
            }
        }

        $imagePath = $image->saveToDir($dir);
        if(empty($imagePath)) {
            $this->addError($attribute, 'Не удалось сохранить изображение');
            return false;
        }

        $setImagePath($imagePath);
        MagicImage::deleteImage($currentImagePath);
        return true;
    }

}