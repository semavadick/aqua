<?php

namespace app\assets;

/**
 * Ассет для загрузки файла пользователя
 */
class UFile extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/u-file.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\General',
    ];

} 