<?php

namespace app\assets;

/**
 * Общие ассеты для fancy box
 */
class FancyBox extends Asset {

    /**
     * @inheritDoc
     */
    public $css = [
        'js/fancybox/jquery.fancybox.css',
        'js/fancybox/helpers/jquery.fancybox-buttons.css',
        'js/fancybox/helpers/jquery.fancybox-thumbs.css',
    ];

    /**
     * @inheritDoc
     */
    public $js = [
        'js/fancybox/jquery.mousewheel-3.0.6.pack.js',
        'js/fancybox/jquery.fancybox.pack.js',
        'js/fancybox/helpers/jquery.fancybox-buttons.js',
        'js/fancybox/helpers/jquery.fancybox-thumbs.js',
    ];

    /**
     * @inheritDoc
     */
    public $depends = [
        'app\assets\General',
    ];

} 