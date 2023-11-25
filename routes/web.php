<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/do-login', 'AuthController@doLogin');
Route::get('/do-logout', 'AuthController@logout')->name('logout');

Route::get('/register', 'AuthController@register');
Route::post('/do-register', 'AuthController@doRegister');

Route::middleware('auth')->group(function() {
    Route::get('/', 'HomeController@index');

    Route::prefix('/e-ktp')->group(function() {
        Route::get('/search-by-nkk', 'EKtpController@search_by_nkk');
        Route::get('/search-by-nik', 'EKtpController@search_by_nik');
		Route::get('/search-by-profile', 'EKtpController@search_by_profile');
    });

    Route::prefix('/telecommunication')->group(function() {
        Route::get('/locate-number', 'TelecommunicationController@locate_number');
        Route::get('/tracking-number', 'TelecommunicationController@tracking_number');
        Route::get('/telco_registration', 'TelecommunicationController@telco_registration');
        Route::get('/tracking_imsi_imei', 'TelecommunicationController@imei_imsi');
        // Route::post('/save', 'KtpController@save');
    });

    Route::prefix('/transportasi')->group(function() {
        Route::get('/cek_kendaraan', 'TransportasiController@cek_kendaraan');
        // Route::post('/save', 'KtpController@save');
    });
    
    Route::prefix('/dataleak')->group(function() {
        Route::get('/data-leak', 'DataLeakController@data_leak');
        Route::get('/data-gmail', 'DataLeakController@gmail_leak');
        Route::get('/data-sosmed', 'DataLeakController@sosmed_leak');
        // Route::post('/save', 'KtpController@save');
    });
    
    Route::get('/webtools', 'WebtoolsController@index');
    Route::get('/spidertools', 'SpidertoolsController@index');
});
