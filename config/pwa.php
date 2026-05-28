<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Would you like the install button to appear on all pages?
      Set true/false
    |--------------------------------------------------------------------------
    */

    'install-button' => true,

    /*
    |--------------------------------------------------------------------------
    | PWA Manifest Configuration
    |--------------------------------------------------------------------------
    |  php artisan erag:update-manifest
    */

    // 'manifest' => [
    //     'name' => 'Laravel PWA',
    //     'short_name' => 'LPT',
    //     'background_color' => '#6777ef',
    //     'display' => 'fullscreen',
    //     'description' => 'A Progressive Web Application setup for Laravel projects.',
    //     'theme_color' => '#6777ef',
    //     'icons' => [
    //         [
    //             'src' => 'logo.png',
    //             'sizes' => '512x512',
    //             'type' => 'image/png',
    //         ],
    //     ],
    // ],

     'manifest' => [
        'name' => null,
        'short_name' => null,
        'background_color' => '#ffffff',
        'display' => 'fullscreen',
        'description' => 'A Progressive Web Application setup for Laravel projects.',
        'theme_color' => '#ffffff',
        'icons' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Debug Configuration
    |--------------------------------------------------------------------------
    | Toggles the application's debug mode based on the environment variable
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Livewire Integration
    |--------------------------------------------------------------------------
    | Set to true if you're using Livewire in your application to enable
    | Livewire-specific PWA optimizations or features.
    */

    'livewire-app' => true,
];
