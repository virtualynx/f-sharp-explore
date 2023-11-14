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

Route::prefix('/e-ktp')->group(function() {
    Route::post('/search-by-nik', 'Api\EKtpApi@search_by_nik')->name('api_ektp_search_by_nik');
});

Route::prefix('/telecommunication')->group(function() {
    // Route::get('/tracking-msisdn/{msisdn}', 'Api\TelecommunicationApi@tracking_msisdn');
    Route::post('/locate-msisdn', 'Api\TelecommunicationApi@locate_msisdn')->name('api_locate_number');
});

Route::prefix('/transportasi')->group(function() {
    // Route::get('/tracking-msisdn/{msisdn}', 'Api\TelecommunicationApi@tracking_msisdn');
    Route::post('/tracking_kendaraan', 'Api\TransportasiApi@tracking_kendaraan');
});
