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

Route::get('/login', 'AuthController@login');
Route::post('/do-login', 'AuthController@doLogin');

Route::get('/register', 'AuthController@register');
Route::post('/do-register', 'AuthController@doRegister');

Route::get('/', 'HomeController@index');

Route::prefix('/telecommunication')->group(function() {
    Route::get('/tracking-number', 'TelecommunicationController@tracking_number');
    // Route::post('/save', 'KtpController@save');
});

Route::middleware('authorized')->group(function() {
});
