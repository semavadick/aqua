<?php

namespace app\assets;

/**
 * Общие ассеты для статической страницы Реконструкция бассейнов
 */
class Rebuilding extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/rebuilding.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\BxSlider',
    ];

}