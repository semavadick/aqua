<?php

namespace app\assets;

/**
 * Общие ассеты для профиля пользвателя
 */
class Profile extends Asset {

    /**
     * @inheritDoc
     */
    public $js = [
        'js/profile.js',
    ];

    /** @inheritdoc */
    public $depends = [
        'app\assets\General',
    ];

} 