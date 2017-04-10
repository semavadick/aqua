<?php

namespace back\helpers;

class HandyFile {

    private $blob = null;
    private $name = null;

    /**
     * Constructor
     */
    private function __construct() {}

    /**
     * Фабричный метод. Создает файл из data-url
     * @param string $url URL до файла
     * @param string $name Название файла
     * @return MagicImage|null
     */
    public static function createFromDataUrl($url, $name) {
        $file = new HandyFile();
        $base64 = substr($url, strpos($url, ',') + 1);
        $file->blob = base64_decode($base64);
        $file->name =$name;
        return $file;
    }

    /**
     * Фабричный метод. Создает файл из data-url
     * @param string $path Путь до файла
     * @param string $name Название файла
     * @return MagicImage|null
     */
    public static function createFromPath($path, $name) {
        $file = new HandyFile();
        $file->blob = file_get_contents($path);
        $file->name = $name;
        return $file;
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

        $blob = $this->blob;
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
     * @param bool $generateName
     * @return bool Результат операции
     */
    public function saveToDir($dirPath, $generateName = false) {
        $name = explode('.', $this->name);
        $name = array_shift($name);
        $name = mb_strtolower($name);
        $name = strtr($name, [
            ' ' => '-',
            '/' => '-',
            '\\' => '-',
        ]);
        if($generateName) {
            $name = uniqid();
        }
        $extension = $this->getExtension();
        $i = 0;
        do {
            $uniq = $i > 0 ? "-{$i}" : "";
            $path = "{$dirPath}/{$name}{$uniq}.{$extension}";
            $fullPath = \Yii::getAlias('@webroot') . '/' . $path;
            $i++;
        } while(file_exists($fullPath));
        if(!$this->saveTo($fullPath)) {
            return null;
        }
        return $path;
    }

    public function getExtension() {
        return strtolower(pathinfo($this->name, PATHINFO_EXTENSION));
    }

    public function getSize() {
        return strlen($this->blob);
    }

    public function getBlob(){
        return $this->blob;
    }

    /**
     * Удаляет файл
     * @param string $path Путь до файла (относительно webroot)
     * @return bool Результат операции
     */
    public static function deleteFile($path) {
        $fullPath = \Yii::getAlias('@webroot') . '/' . $path;
        return is_file($fullPath) && unlink($fullPath);
    }

}