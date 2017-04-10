<?php
/**
 * Конифг для компонента urlManager
 */

return [
    'class' => 'codemix\localeurls\UrlManager',

    'languages' => ['ru', 'en'],
    'enableDefaultLanguageUrlCode' => false,
    'enableLanguageDetection' => false,
    'enableLanguagePersistence' => false,

    'showScriptName' => false,
    'enablePrettyUrl' => true,
    'rules' => [
        '' => 'site/index',
        'about' => 'about/index',

        'building' => 'building/index',
        'pool-type/<slug:.*>' => 'building/type',

        'galleries/type/<slug:.*>' => 'galleries/type',
        'galleries/manufacturing' => 'galleries/production-gallery',
        'galleries/<slug:.*>' => 'galleries/gallery',

        'services/maintenance' => 'services/maintenance',

        'knowledge' => 'articles/index',
        'knowledge/<slug:.*>' => 'articles/article',

        'news' => 'news/index',
        'news/<slug:.*>' => 'news/news-item',

        'store' => 'store/index',
        'store/grid-view/<type:.*>' => 'store/grid-view',
        'store/sync-cart' => 'store/sync-cart',
        'store/create-order' => 'store/create-order',
        'store/send-help-request' => 'store/send-help-request',
        'store/send-catalog-request' => 'store/send-catalog-request',
        'store/product/<slug:.*>' => 'store/product',
        'store/<categorySlug:.*>' => 'store/store',

        'addresses' => 'addresses/index',

        'search' => 'search/index',
    ]
];