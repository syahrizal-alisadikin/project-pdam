<?php

use App\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth Controller
Route::group(['namespace' => 'Api'], function () {
	Route::POST('/login', 'LoginController@index'); // Login
	Route::POST('/warga-register', 'WargaController@register'); // Register

	Route::GET('/logout', 'LoginController@logout');
});

Route::group(['middleware' => ['jwt.auth'], 'namespace' => 'Api'], function () {

	// Warga Controller
	Route::GET('warga', 'WargaController@index'); // Get All Warga
	Route::GET('warga/edit/{warga_id}', 'WargaController@GetIDWarga'); // Get Warga Per ID
	Route::POST('warga/update/{warga_id}', 'WargaController@updateData'); // Update Warga Process 
	Route::DELETE('warga/delete/{warga_id}', 'WargaController@deleteWarga'); // Delete Warga Process

	// Kejadian Controller
	Route::POST('kejadian', 'KejadianController@insertKejadian');
	Route::GET('kejadian/param_kejadian/{param_id}', 'KejadianController@GetParamKejadian');

	// File Get Name
	Route::get('image/{file}', 'WargaController@fileMateri');
});
