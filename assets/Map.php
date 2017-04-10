<?php

namespace app\assets;

/**
 * Общие ассеты для Карты
 */
class Map extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/map.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\General',
    ];

} 