<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'key' => [
        'msisdn_track' => env('API_KEY_MSISDN_TRACK'),
    ],
    'base_uri' => [
        'msisdn_track' => env('API_BASE_URI_MSISDN_TRACK'),
    ],
    'uri' => [
        'msisdn_track' => env('API_URI_MSISDN_TRACK'),
    ]
];
