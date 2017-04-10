<?php

namespace app\assets;

/**
 * Общие ассеты для главной страницы
 */
class Main extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/main.js',
    ];

    /**
     * @inheritDoc
     */
    public $depends = [
        'app\assets\General',
        'app\assets\BxSlider',
    ];

} 