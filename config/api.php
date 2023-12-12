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
        'binderbyte' => env('API_KEY_BINDERBYTE'),
        'goapi' => env('API_KEY_GOAPI'),
    ],
    'base_uri' => [
        'general' => env('API_BASE_URI_GENERAL'),
        'kujang' => env('API_BASE_URI_KUJANG'),
        'geocoding' => env('API_BASE_URI_BDC'),
        'binderbyte' => env('API_BASE_URI_BINDERBYTE'),
        'goapi' => env('API_BASE_URI_GOAPI'),
    ],
    'uri' => [
        'general' => [
            'msisdn_track' => env('API_URI_GENERAL_MSISDN_TRACK'),
            'ktp_data' => env('API_URI_GENERAL_KTP_DATA'),
            'kendaraan_track' => env('API_URI_GENERAL_KENDARAAN_TRACK'),
            'telco_registration' => env('API_URI_GENERAL_REGISTRASI'),
            'data_leak' => env('API_URI_GENERAL_DATALEAK'),
            'karakter' => env('API_URI_GENERAL_KARAKTER'),
            'gmail_password' => env('API_URI_GENERAL_GMAIL_PASSWORD'),
            'sosmed_leak' => env('API_URI_GENERAL_SOSMED')
        ],
        'kujang' => env('API_URI_KUJANG'),
        'geocoding' => [
            'reverse_geocode' => env('API_URI_BDC_REV_GEOCODE')
        ],
    ],
];
