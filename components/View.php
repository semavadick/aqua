<?php

namespace app\components;
use app\controllers\Controller;

/**
 * Компонент вида
 */
class View extends \yii\web\View
{

    /**
     * @var Controller
     */
    public $context;

    /**
     * @return string Title страницы
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Устанавливает title страницы
     *
     * @param string $title Title страницы
     */
    public function setTitle($title) {
        $this->title = strval($title);
    }

    /**
     * @var string Meta-keywords страницы
     */
    protected $_metaKeywords = '';

    /**
     * @param string $value Meta-keywords страницы
     */
    public function setMetaKeywords($value)
    {
        $this->_metaKeywords = strval($value);
    }

    /**
     * @return string $value Meta-keywords страницы
     */
    public function getMetaKeywords()
    {
        return $this->_metaKeywords;
    }

    /**
     * @var string Meta-description страницы
     */
    protected $_metaDescription = '';

    /**
     * @param string $value Meta-description страницы
     */
    public function setMetaDescription($value)
    {
        $this->_metaDescription = strval($value);
    }

    /**
     * @return string $value Meta-description страницы
     */
    public function getMetaDescription()
    {
        return $this->_metaDescription;
    }

    /**
     * @param string $file Путь до файла (относительно папки frontend)
     * @return string URL опубликованного frontend файла
     */
    public function getPublishedFileUrl($file)
    {
        $frontendPath = (new \app\assets\General())->sourcePath;
        $frontendUrl = $this->getAssetManager()
                            ->getPublishedUrl($frontendPath);
        return "$frontendUrl/$file";
    }

} 