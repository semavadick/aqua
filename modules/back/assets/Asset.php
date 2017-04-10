<?php

namespace back\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Абстрактный класс для ассетов в админке
 */
abstract class Asset extends AssetBundle
{
    /**
     * @inheritDoc
     */
    public $sourcePath = '@back/frontend';

    /**
     * @inheritDoc
     */
    public $jsOptions = [
        'position' => View::POS_END,
    ];

} 