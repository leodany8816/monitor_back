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

    //'paths' => ['*'],
    'paths' => ['api/*', 'login', 'csrf-cookie'],

    'allowed_methods' => ['*'],

    //'allowed_origins' => [env('FRONTEND_URL', '*')],
    //'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:4321')],
    'allowed_origins' => [env('FRONTEND_URL', 'https://bekaert.grupo-citi.com')],
    //'allowed_origins' => ['https://bekaert.grupo-citi.com'],

    'allowed_origins_patterns' => ['*'],

    'allowed_headers' => ['*'],

    //'allowed_headers' => ['Authorization', 'Content-Type', 'X-Requested-With', 'X-CSRF-TOKEN', '*'],  // Asegúrate de incluir 'Authorization'.

    'exposed_headers' => false,

    'max_age' => 0,

    'supports_credentials' => true,

];
