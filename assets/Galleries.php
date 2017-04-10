<?php

namespace app\assets;

/**
 * Общие ассеты для галерей объектов
 */
class Galleries extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/galleries.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\BxSlider',
    ];

} 