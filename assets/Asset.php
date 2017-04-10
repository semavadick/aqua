<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Абстрактный класс для ассетов на фронтофисе
 */
abstract class Asset extends AssetBundle
{
    /**
     * @inheritDoc
     */
    public $sourcePath = '@app/frontend/src';

    /**
     * @inheritDoc
     */
    public $jsOptions = [
        'position' => View::POS_END,
    ];

} 