<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['POST', 'GET', 'DELETE', 'PUT', '*'],

    'allowed_origins' => ['http://localhost:8080', 'https://paradisopark.com','https://www.paradisopark.com'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type, X-Auth-Token, Origin, Access-Control-Allow-Origin'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
