<?php

namespace app\assets;

/**
 * Общие ассеты для всех стрпниц
 */
class General extends Asset
{
    /**
     * @inheritDoc
     */
    public $css = [
        'css/all.css',
        'css/custom.css',
        'css/my-modal.css',
        'css/jquery.fs.selecter.min.css',
    ];

    /**
     * @inheritDoc
     */
    public $js = [
        'js/jquery-1.12.4.min.js',
        'js/sly.js',
        'js/device.js',
        'js/jquery.easing-1.3.min.js',
        'js/jquery.my-modal.js',
        'js/cart.js',
        'js/general.js',
        'js/jquery.fs.selecter.min.js',
        'js/icheck.min.js',

        /*'js/libs.min.js',
        'js/main.js',*/
    ];

} 