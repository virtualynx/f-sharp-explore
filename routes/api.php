<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/telecommunication')->group(function() {
    // Route::get('/tracking-msisdn/{msisdn}', 'Api\TelecommunicationApi@tracking_msisdn');
    Route::post('/tracking-msisdn', 'Api\TelecommunicationApi@tracking_msisdn');
});
