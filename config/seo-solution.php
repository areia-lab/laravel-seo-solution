<?php

return [
    'route' => [
        'prefix' => env('SEO_PANEL_PREFIX', 'admin/seo'),
        'middleware' => ['web'],
    ],
    'disk' => env('SEO_DISK', 'public'),
    'defaults' => [
        'title_suffix' => '',
    ],
    'cache' => false,

    'panel' => [
        'title_prefix'  => 'Areia Lab'
    ],
];
