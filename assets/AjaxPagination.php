<?php


namespace app\assets;

/**
 * Ассет для плагина ajaxPagination
 */
class AjaxPagination extends Asset
{
    /**
     * @inheritDoc
     */
    public $js = [
        'js/jquery.ajaxPagination.js'
    ];

    /**
     * @inheritDoc
     */
    public $depends = [
        '\app\assets\General',
    ];
} 