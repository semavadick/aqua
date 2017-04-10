<?php

namespace back\components;

/**
 * Компонент вида
 */
class View extends \yii\web\View
{

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
     * @var array Хлебные крошки {@link getBreadcrumbs}
     */
    protected $_breadCrumbs = [];

    /**
     * @return array Хлебные крошки
     * <ul>
     *  <li>
     *      label
     *  </li>
     *  <li>
     *      url
     *  </li>
     * </ul>
     */
    public function getBreadcrumbs() {
        return $this->_breadCrumbs;
    }

    /**
     * Добавляет элемент в хлебные крошки
     *
     * @param string $label Лейбл
     * @param string $url Url
     */
    public function addBreadcrumb($label, $url) {
        $this->_breadCrumbs[] = [
            'label' => strval($label),
            'url' => strval($url),
        ];
    }

} 