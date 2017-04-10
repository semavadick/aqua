<?php

Yii::setAlias('@back', __DIR__ . '/../');
Yii::setAlias('@back/MainPage', __DIR__ . '/../modules/main-page');
Yii::setAlias('@back/AboutPage', __DIR__ . '/../modules/about-page');
Yii::setAlias('@back/Publications', __DIR__ . '/../modules/publications');
Yii::setAlias('@back/News', __DIR__ . '/../modules/news');
Yii::setAlias('@back/Articles', __DIR__ . '/../modules/articles');
Yii::setAlias('@back/PoolsBuilding', __DIR__ . '/../modules/pools-building');
Yii::setAlias('@back/ObjectGalleries', __DIR__ . '/../modules/object-galleries');
Yii::setAlias('@back/Services', __DIR__ . '/../modules/services');
Yii::setAlias('@back/Catalog', __DIR__ . '/../modules/catalog');
Yii::setAlias('@back/Users', __DIR__ . '/../modules/users');
Yii::setAlias('@back/Orders', __DIR__ . '/../modules/orders');
Yii::setAlias('@back/Settings', __DIR__ . '/../modules/settings');
Yii::setAlias('@back/Dashboard', __DIR__ . '/../modules/dashboard');
return [
    'modules' => [
        'back' => [
            'class' => 'back\Module',
            'components' => [
                'mailer' => require(__DIR__ . '/components/mailer.php'),
            ],
            'modules' => [
                'main-page' => [
                    'class' => 'back\MainPage\Module',
                ],

                'about-page' => [
                    'class' => 'back\AboutPage\Module',
                ],

                'news' => [
                    'class' => 'back\News\Module',
                ],

                'articles' => [
                    'class' => 'back\Articles\Module',
                ],

                'pools-building' => [
                    'class' => 'back\PoolsBuilding\Module',
                ],

                'object-galleries' => [
                    'class' => 'back\ObjectGalleries\Module',
                ],

                'services' => [
                    'class' => 'back\Services\Module',
                ],

                'catalog' => [
                    'class' => 'back\Catalog\Module',
                ],

                'users' => [
                    'class' => 'back\Users\Module',
                ],

                'orders' => [
                    'class' => 'back\Orders\Module',
                ],

                'settings' => [
                    'class' => 'back\Settings\Module',
                ],

                'dashboard' => [
                    'class' => 'back\Dashboard\Module',
                ],
            ],
        ],
    ],
    'components' => [
        'log' => [
            'flushInterval' => 1,
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'exportInterval' => 1,
                    'levels' => ['error','info','warning','trace','profile'],
                    'logFile' => '@webroot/files/log.txt',
                    'logVars' => []
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                'back-office' => 'back/frontend/index',
                'back-office/<file:.*>' => 'back/frontend/index',

                'back/dashboard' => 'back/dashboard/dashboard/index',

                'back/main-page/content' => 'back/main-page/seo/index',
                'back/main-page/about' => 'back/main-page/about/index',
                'back/main-page/banners' => 'back/main-page/banners/index',
                'back/main-page/banners/<id:\d+>' => 'back/main-page/banners/index',
                'back/main-page/slides' => 'back/main-page/slides/index',
                'back/main-page/slides/<id:\d+>' => 'back/main-page/slides/index',

                'back/about-page/seo' => 'back/about-page/seo/index',
                'back/about-page/history' => 'back/about-page/history/index',
                'back/about-page/history-stages' => 'back/about-page/history-stages/index',
                'back/about-page/history-stages/<id:\d+>' => 'back/about-page/history-stages/index',
                'back/about-page/competence' => 'back/about-page/competence/index',
                'back/about-page/production' => 'back/about-page/production/index',
                'back/about-page/production-banners' => 'back/about-page/banners/index',
                'back/about-page/production-banners/<id:\d+>' => 'back/about-page/banners/index',
                'back/about-page/production-images' => 'back/about-page/production-images/index',
                'back/about-page/production-images/<id:\d+>' => 'back/about-page/production-images/index',
                'back/about-page/advantages-block' => 'back/about-page/advantages-block/index',
                'back/about-page/advantages' => 'back/about-page/advantages/index',
                'back/about-page/advantages/<id:\d+>' => 'back/about-page/advantages/index',
                'back/about-page/certificates-block' => 'back/about-page/certificates-block/index',
                'back/about-page/certificates' => 'back/about-page/certificates/index',
                'back/about-page/certificates/sort' => 'back/about-page/certificates/sort',
                'back/about-page/certificates/<id:\d+>' => 'back/about-page/certificates/index',
                'back/about-page/contacts-block' => 'back/about-page/contacts-block/index',
                'back/about-page/regions' => 'back/about-page/office-regions/index',
                'back/about-page/regions/<id:\d+>' => 'back/about-page/office-regions/index',
                'back/about-page/offices' => 'back/about-page/offices/index',
                'back/about-page/offices/regions' => 'back/about-page/offices/regions',
                'back/about-page/offices/<id:\d+>' => 'back/about-page/offices/index',

                'back/news/<offset:\d+>-<limit:\d+>/<sortAttribute:\w*>-<sortDirection:\d+>/<searchAttributes:.*>' => 'back/news/news/index',
                'back/news/<id:\d+>' => 'back/news/news/index',
                'back/news' => 'back/news/news/index',

                'back/articles/<offset:\d+>-<limit:\d+>/<sortAttribute:\w*>-<sortDirection:\d+>/<searchAttributes:.*>' => 'back/articles/articles/index',
                'back/articles/<id:\d+>' => 'back/articles/articles/index',
                'back/articles' => 'back/articles/articles/index',

                'back/pools-building/pool-types' => 'back/pools-building/pool-types/index',
                'back/pools-building/pool-types/<id:\d+>' => 'back/pools-building/pool-types/index',
                'back/pools-building/advantages' => 'back/pools-building/advantages/index',
                'back/pools-building/advantages/<id:\d+>' => 'back/pools-building/advantages/index',
                'back/pools-building/faq' => 'back/pools-building/faq/index',
                'back/pools-building/faq/<id:\d+>' => 'back/pools-building/faq/index',
                'back/pools-building/project' => 'back/pools-building/project/index',
                'back/pools-building/design' => 'back/pools-building/design/index',
                'back/pools-building/rebuilding' => 'back/pools-building/rebuilding/index',
                'back/pools-building/building' => 'back/pools-building/building/index',
                'back/pools-building/seo' => 'back/pools-building/seo/index',

                'back/object-galleries/<offset:\d+>-<limit:\d+>/<sortAttribute:\w*>-<sortDirection:\d+>' => 'back/object-galleries/galleries/index',
                'back/object-galleries/<id:\d+>' => 'back/object-galleries/galleries/index',
                'back/object-galleries/pool-types' => 'back/object-galleries/galleries/pool-types',
                'back/object-galleries' => 'back/object-galleries/galleries/index',

                'back/services/maintenance' => 'back/services/maintenance/index',
                'back/services/exclusive' => 'back/services/exclusive/index',

                'back/catalog/categories' => 'back/catalog/categories/index',
                'back/catalog/categories/sort' => 'back/catalog/categories/sort',
                'back/catalog/categories/<id:\d+>' => 'back/catalog/categories/index',
                'back/catalog/addition-categories' => 'back/catalog/addition-categories/index',
                'back/catalog/addition-categories/sort' => 'back/catalog/addition-categories/sort',
                'back/catalog/addition-categories/<id:\d+>' => 'back/catalog/addition-categories/index',


                'back/catalog/products' => 'back/catalog/products/index',
                'back/catalog/products/<id:\d+>' => 'back/catalog/products/index',
                'back/catalog/products/sort'     => 'back/catalog/products/sort',
                'back/catalog/products/<offset:\d+>-<limit:\d+>/<sortAttribute:\w*>-<sortDirection:\d+>/<searchAttributes:.*>' => 'back/catalog/products/index',
                'back/catalog/product-form-select' => 'back/catalog/products/form-select',
                'back/catalog/product-form-select/<categoryId:\d+>' => 'back/catalog/products/form-select',

                'back/catalog/addition-products' => 'back/catalog/addition-products/index',
                'back/catalog/addition-products/<id:\d+>' => 'back/catalog/addition-products/index',
                'back/catalog/addition-products/sort'     => 'back/catalog/products/sort',
                'back/catalog/addition-products/<offset:\d+>-<limit:\d+>/<sortAttribute:\w*>-<sortDirection:\d+>/<searchAttributes:.*>' => 'back/catalog/addition-products/index',
                'back/catalog/addition-product-form-select' => 'back/catalog/addition-products/form-select',
                'back/catalog/addition-product-form-select/<categoryId:\d+>' => 'back/catalog/addition-products/form-select',
                'back/catalog/related-addition-products/<query:.*>' => 'back/catalog/addition-products/related-products',
                'back/catalog/general' => 'back/catalog/general/index',
                'back/catalog/attachments' => 'back/catalog/attachments/index',
                'back/catalog/attachments/<id:\d+>' => 'back/catalog/attachments/index',
                'back/catalog/related-products/<query:.*>' => 'back/catalog/products/related-products',

                'back/users' => 'back/users/users/index',
                'back/users/<id:\d+>' => 'back/users/users/index',
                'back/users/discount-categories' => 'back/users/users/discount-categories',
                'back/users/discount-categories/<id:\d+>' => 'back/users/users/discount-categories',
                'back/users/<offset:\d+>-<limit:\d+>/<sortAttribute:\w*>-<sortDirection:\d+>/<searchAttributes:.*>' => 'back/users/users/index',

                'back/orders' => 'back/orders/orders/index',
                'back/orders/<id:\d+>' => 'back/orders/orders/index',
                'back/orders/clients' => 'back/orders/orders/clients',
                'back/orders/<offset:\d+>-<limit:\d+>/<sortAttribute:\w*>-<sortDirection:\d+>/<searchAttributes:.*>' => 'back/orders/orders/index',

                'back/settings' => 'back/settings/settings/index',
            ],
        ]
    ],
];