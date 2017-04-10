<?php

namespace app\assets;

/**
 * Общие ассеты для страницы О компании
 */
class Maintenance extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/maintenance.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\General',
    ];

} 