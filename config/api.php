<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'key' => [
        'msisdn_track' => env('API_KEY_MSISDN_TRACK'),
    ],
    'endpoint' => [
        'msisdn_track' => env('API_ENPOINT_MSISDN_TRACK'),
    ]
];
