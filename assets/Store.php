<?php

namespace app\assets;

/**
 * Ассеты для страницы каталога
 */
class Store extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/icheck.min.js',
        'js/store.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\General',
    ];

} 