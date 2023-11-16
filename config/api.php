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
        'general' => env('API_KEY_GENERAL'),
    ],
    'base_uri' => [
        'general' => env('API_BASE_URI_GENERAL'),
        'kujang' => env('API_BASE_URI_KUJANG'),
    ],
    'uri' => [
        'general' => [
            'msisdn_track' => env('API_URI_GENERAL_MSISDN_TRACK'),
            'ktp_data' => env('API_URI_GENERAL_KTP_DATA'),
            'kendaraan_track' => env('API_URI_GENERAL_KENDARAAN_TRACK'),
            'telco_registration' => env('API_URI_GENERAL_REGISTRASI')
        ],
        'kujang' => env('API_URI_KUJANG'),
    ]
];
