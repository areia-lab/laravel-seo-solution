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
        'middleware' => ['web'], // auth protects the panel

        'dashboard_label' => 'Back to Dashboard',
        'dashboard_url'   => '/',
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

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Menu Settings
    |--------------------------------------------------------------------------
    |
    | Define which sidebar menu sections should be visible in the admin panel.
    | Set each option to `true` to enable or `false` to disable.
    |
    | - global : Controls access to global menu items (e.g., dashboard, settings)
    | - pages  : Controls visibility of custom page management
    | - model  : Controls access to model-based CRUD menus
    |
    */
    'menu' => [
        'global' => true,  // Show global items
        'pages'  => true,  // Enable custom pages section
        'model'  => false, // Hide model management by default
    ],

];
