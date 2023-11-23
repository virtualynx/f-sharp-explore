<?php

namespace App\Services;

use GuzzleHttp\Client;

abstract class _GeneralService
{
    private string $base_uri;

    public function __construct()
    {
        $this->base_uri = config('api.base_uri.general');
    }

    private function generateHeader()
    {
        $api_key = config('api.key.general');

        return [
            // 'User-Agent' => 'insomnia/8.3.0',
            'auth_key' => $api_key,
        ];
    }

    private function generateHeaderPost()
    {
        $api_key = config('api.key.general');

        return [
            // 'User-Agent' => 'insomnia/8.3.0',
            'auth_key' => $api_key,

            'Content-Type' => 'application/json'


        ];
    }

    protected function getHttpClient()
    {
        return new Client([
            'base_uri' => $this->base_uri,
            'headers' => $this->generateHeader()
        ]);
    }

    protected function getHttpClientPost()
    {
        return new Client([
            'base_uri' => $this->base_uri,
            'headers' => $this->generateHeaderPost()
        ]);
    }
}
