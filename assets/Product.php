<?php

namespace app\assets;

/**
 * Ассеты для страницы товара
 */
class Product extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/product.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\Store',
        'app\assets\BxSlider',
    ];

} 