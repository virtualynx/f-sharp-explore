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
    Route::post('/search_by_nkk', 'Api\EKtpApi@search_by_nkk');
    Route::post('/search_by_dob', 'Api\EKtpApi@search_by_dob');
    
});

Route::prefix('/telecommunication')->group(function() {
    Route::post('/locate-msisdn', 'Api\TelecommunicationApi@locate_msisdn')->name('api_locate_number');
    Route::post('/telco_registration', 'Api\TelecommunicationApi@telco_registration')->name('telco_registration');
    Route::get('/tracking', 'Api\TelecommunicationApi@datatable_tracked_numbers')->name('api_tracked_number_list');
    Route::get('/tracking/{msisdn}', 'Api\TelecommunicationApi@get_tracked_number');
    Route::post('/tracking', 'Api\TelecommunicationApi@save_tracked_number')->name('api_tracked_number_save');
    Route::delete('/tracking', 'Api\TelecommunicationApi@delete_tracked_number')->name('api_tracked_number_delete');
    Route::get('/tracking-log-datatable/{msisdn}', 'Api\TelecommunicationApi@datatable_tracking_log');
    Route::post('/tracking-toggle', 'Api\TelecommunicationApi@toggle_tracking_number')->name('api_tracking_toggle');
    Route::get('/tracking-geofence/{msisdn}', 'Api\TelecommunicationApi@get_geofence_v2');
    Route::post('/tracking-geofence', 'Api\TelecommunicationApi@save_geofence')->name('api_tracking_geofence_save');
});

Route::prefix('/transportasi')->group(function() {
    // Route::get('/tracking-msisdn/{msisdn}', 'Api\TelecommunicationApi@tracking_msisdn');
    Route::post('/tracking_kendaraan', 'Api\TransportasiApi@tracking_kendaraan');
});

Route::prefix('/dataleak')->group(function() {
    // Route::get('/tracking-msisdn/{msisdn}', 'Api\TelecommunicationApi@tracking_msisdn');
    Route::post('/data_leak', 'Api\DataLeakApi@data_leak');
});
