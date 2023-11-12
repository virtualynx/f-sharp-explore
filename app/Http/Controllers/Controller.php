<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getInsomniaHeader(){
        $api_key = config('api.key.insomnia');

        return [
            'User-Agent' => 'insomnia/8.3.0',
            'auth_key' => $api_key
        ];
    }
}
