<?php

namespace back\helpers;

/**
 * Класс для работы с изображением
 */
class MagicImage {

    /**
     * Формат - jpeg
     */
    const FORMAT_JPEG = 'JPEG';

    /**
     * Формат - png
     */
    const FORMAT_PNG = 'PNG';

    /**
     * Формат - gif
     */
    const FORMAT_GIF = 'GIF';

    /**
     * @var \Imagick Image thumb
     */
    protected $thumb;

    /**
     * @var string Формат
     */
    protected $format;

    /**
     * @var string|null Цвет фона (hex)
     */
    protected $backgroundColor;

    /**
     * Constructor
     */
    private function __construct() {}

    /**
     * Destructor
     */
    public function __destruct() {
        $this->thumb->clear();
        $this->thumb->destroy();
    }

    /**
     * Фабричный метод. Создает изображение из указанного файла
     * @param string $path Путь до файла
     * @return MagicImage|null
     */
    public static function createFromLocalFile($path) {
        if(!is_file($path)) {
            return null;
        }
        $image = new MagicImage();
        $image->thumb = new \Imagick();
        if(!$image->thumb->readImage($path)) {
            return null;
        }
        $image->thumb = $image->thumb->coalesceImages();
        $image->format = $image->thumb->getImageFormat();
        return $image;
    }

    /**
     * Фабричный метод. Создает изображение из указанного файла
     * @param string $url URL до файла
     * @return MagicImage|null
     */
    public static function createFromUrl($url) {
        $image = new MagicImage();
        $image->thumb = new \Imagick();
        if(!$image->thumb->readImage($url)) {
            return null;
        }
        $image->thumb = $image->thumb->coalesceImages();
        $image->format = $image->thumb->getImageFormat();
        return $image;
    }

    /**
     * Фабричный метод. Создает изображение из data-url
     * @param string $url URL до файла
     * @return MagicImage|null
     */
    public static function createFromDataUrl($url) {
        $base64 = substr($url, strpos($url, ',') + 1);
        $blob = base64_decode($base64);
        $image = new MagicImage();
        $image->thumb = new \Imagick();
        try {
            if(!$image->thumb->readImageBlob($blob)) {
                return null;
            }
        } catch(\Exception $e) {
            return null;
        }

        $image->thumb = $image->thumb->coalesceImages();
        $image->format = $image->thumb->getImageFormat();
        return $image;
    }

    /**
     * Сохраняет изображение по указанному пути
     * @param string $path Путь
     * @return bool Результат операции
     */
    public function saveTo($path) {
        // Check a directory
        $dirName = pathinfo($path, PATHINFO_DIRNAME);
        if(is_file($dirName)) {
            return false;
        }
        // Create the directory if
        // it doesn't exist
        if(!file_exists($dirName)) {
            if(!mkdir($dirName, 0777, true)) {
                return false;
            }
        }

        $blob = $this->getBlob();
        if(is_null($blob)) {
            return false;
        }

        if(file_exists($path)) {
            return false;
        }
        return file_put_contents($path, $blob);
    }

    /**
     * Сохраняет изображение по указанному пути
     * @param string $dirPath Путь до директории (относительно webroot)
     * @return bool Результат операции
     */
    public function saveToDir($dirPath) {
        $extension = $this->getFileExtension();
        do {
            $path = $dirPath . '/' . uniqid() . '.' . $extension;
            $fullPath = \Yii::getAlias('@webroot') . '/' . $path;
        } while(file_exists($fullPath));
        if(!$this->saveTo($fullPath)) {
            return null;
        }
        return $path;
    }

    public function getFileExtension() {
        $extensions = [
            self::FORMAT_JPEG => 'jpg',
            self::FORMAT_PNG => 'png',
            self::FORMAT_GIF => 'gif',
        ];
        $format = $this->thumb->getImageFormat();
        return isset($extensions[$format]) ? $extensions[$format] : 'jpg';
    }

    /**
     * @return string|null Image blob (null в случае ошибки)
     */
    public function getBlob() {
        $thumb = $this->thumb;
        try {
            // Add background
            if(!empty($this->backgroundColor)) {
                $background = new \Imagick();
                $result = $background->newImage($this->getWidth(), $this->getHeight(), $this->backgroundColor);
                $result = $result && $background->compositeImage($thumb, \Imagick::COMPOSITE_OVER, 0, 0);
                if(!$result) {
                    return null;
                }
                $thumb = $background;
            }

            // Format
            if(!$thumb->setImageFormat($this->format)) {
                return null;
            }

            return $thumb->getImageBlob();

        } catch(\Exception $e) {
            return null;
        }
    }

    /**
     * @return int Ширина
     */
    public function getWidth() {
        return $this->thumb->getImageWidth();
    }

    /**
     * @return int Высота
     */
    public function getHeight() {
        return $this->thumb->getImageHeight();
    }

    /**
     * Ресайзит изображение
     * @param int $width Ширина
     * @param int $height Высота
     * @return boolean Результат операции
     */
    public function resize($width, $height) {
        foreach($this->thumb as $frame) {
            if(
                !$frame->scaleimage($width, $height)
                || !$frame->setimagepage(0, 0, 0, 0)
            ) {
                return false;
            }
        }
        return true;
    }

    /**
     * Ресайзит изображение
     * @param int $maxWidth Макс. ширина
     * @param int $maxHeight Макс. высота
     * @return boolean Результат операции
     */
    public function resizeToMaxSize($maxWidth, $maxHeight) {
        $width = $this->thumb->getImageWidth();
        $height = $this->thumb->getImageHeight();
        $ratio = $width / $height;
        if($width > $maxWidth) {
            $width = $maxWidth;
            $height = $width / $ratio;
        }
        if($height > $maxHeight) {
            $height = $maxHeight;
            $width = $height * $ratio;
        }
        foreach($this->thumb as $frame) {
            if(
                !$frame->scaleimage($width, $height)
                || !$frame->setimagepage(0, 0, 0, 0)
            ) {
                return false;
            }
        }
        return true;
    }

    /**
     * Образает изображение
     * @param int $x X координата (0-100%)
     * @param int $width Ширина (0-100%)
     * @param int $y Y координата (0-100%)
     * @param int $height Высота (0-100%)
     * @return bool Результат операции
     */
    public function crop($x, $width, $y, $height) {
        $thumbWidth = $this->getWidth();
        $thumbHeight = $this->getHeight();
        $cropX = floor(($x * $thumbWidth) / 100);
        $cropY = floor(($y * $thumbHeight) / 100);
        $cropWidth = floor(($width * $thumbWidth) / 100);
        $cropHeight = floor(($height * $thumbHeight) / 100);

        foreach($this->thumb as $frame) {
            if(
                !$frame->cropImage($cropWidth, $cropHeight, $cropX, $cropY)
                || !$frame->setimagepage(0, 0, 0, 0)
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return MagicImage Копия изображения
     */
    public function getCopy() {
        $copy = clone $this;
        $copy->thumb = clone $this->thumb;
        return $copy;
    }

    /**
     * Устанавливает цвет фона изображения
     * @param string $color Цвет фона (hex)
     * @return bool Результат операции
     */
    public function setBackgroundColor($color) {
        $this->backgroundColor = $color;
        return true;
    }

    /**
     * Устанавливает формат изображения
     * @param string $format Формат {@see FORMAT_JPEG}
     * @return bool Результат операции
     */
    public function setFormat($format) {
        $this->format = $format;
        return true;
    }

    /**
     * Удаляет изоборажение
     * @param string $path Путь до изображения (относительно webroot)
     * @return bool Результат операции
     */
    public static function deleteImage($path) {
        $fullPath = \Yii::getAlias('@webroot') . '/' . $path;
        return is_file($fullPath) && unlink($fullPath);
    }

}