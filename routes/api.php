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
	Route::post('/login', 'LoginController@index');
	Route::get('/logout', 'LoginController@logout');
});

Route::POST('warga-register', 'Api\WargaController@register');
Route::group(['middleware' => ['jwt.auth'], 'namespace' => 'Api'], function () {

	Route::resources([
		'warga' => 'WargaController',
	]);
	// Warga Update 
	Route::post('warga/update/{warga_id}', 'WargaController@updateData');

	Route::get('image/{file}', 'WargaController@fileMateri');
});
