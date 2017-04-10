<?php

namespace app\assets;

/**
 * Общие ассеты для статей
 */
class Article extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/article.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\BxSlider',
    ];

} 