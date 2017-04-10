<?php

namespace app\assets;

/**
 * Общие ассеты для статей
 */
class Articles extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/articles.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\General',
    ];

} 