<?php

namespace app\assets;

/**
 * Общие ассеты для страницы Строительство бассейнов
 */
class Building extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/building.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\BxSlider',
    ];

} 