<?php

return [
    'route' => [
        'prefix' => env('SEO_PANEL_PREFIX', 'admin/seo'),
        'middleware' => ['web', 'auth'],
    ],
    'disk' => env('SEO_DISK', 'public'),
    'defaults' => [
        'title_suffix' => '',
    ],
];
