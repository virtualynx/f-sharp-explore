<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'oauth' => [
        'url' => env('OAUTH2_URL'),
        'username' => env('OAUTH2_USERNAME'),
        'password' => env('OAUTH2_PASSWORD'),
    ],
    'key' => [
        'msisdn_track' => env('API_KEY_MSISDN_TRACK'),
    ],
    'base_uri' => [
        'msisdn_track' => env('API_BASE_URI_MSISDN_TRACK'),
        'kujang' => env('API_BASE_URI_KUJANG'),
    ],
    'uri' => [
        'kendaraan_track' => env('API_URI_KENDARAAN_TRACK'),
        'msisdn_track' => env('API_URI_MSISDN_TRACK'),
        'kujang' => env('API_URI_KUJANG'),
    ]
];
