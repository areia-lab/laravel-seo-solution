<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Route Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can define the prefix and middleware for the SEO admin panel.
    | For production, it's recommended to protect it with authentication.
    |
    */
    'route' => [
        'prefix' => env('SEO_PANEL_PREFIX', 'admin/seo'), // change if needed
        'middleware' => ['web', 'auth'], // auth protects the panel
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Disk
    |--------------------------------------------------------------------------
    |
    | The disk used to store SEO related assets, images, etc.
    | Use 'public' for local storage or 's3' for cloud storage in production.
    |
    */
    'disk' => env('SEO_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Defaults
    |--------------------------------------------------------------------------
    |
    | Default SEO values, like a title suffix for all pages.
    |
    */
    'defaults' => [
        'title_suffix' => env('SEO_TITLE_SUFFIX', ''), // e.g., " | My Company"
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Enable caching of SEO metadata to improve performance in production.
    |
    */
    'cache' => env('SEO_CACHE', false),

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Settings
    |--------------------------------------------------------------------------
    |
    | Customize the admin panel UI titles and branding.
    |
    */
    'panel' => [
        'title_prefix'  => env('SEO_PANEL_TITLE', 'Areia Lab SEO'),
    ],

];
