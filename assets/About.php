<?php

namespace app\assets;

/**
 * Общие ассеты для страницы О компании
 */
class About extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/about.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\FancyBox',
        'app\assets\BxSlider',
    ];

} 