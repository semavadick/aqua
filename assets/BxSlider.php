<?php

namespace app\assets;

/**
 * Общие ассеты для bx-slider
 */
class BxSlider extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/jquery.bxslider/jquery.bxslider.min.js',
    ];

    /**
     * @inheritDoc
     */
    public $depends = [
        'app\assets\General',
    ];

} 