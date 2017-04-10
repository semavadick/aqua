<?php

namespace app\assets;

/**
 * Общие ассеты для Формы расчета стоимости
 */
class Calc extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/calc.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\General',
    ];

} 