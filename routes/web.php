<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.dashboard');
// });
Route::GET('/login-admin', 'LoginController@index')->name('login-admin');
Route::POST('/login-admin', 'LoginController@postlogin')->name('postLogin');
Route::get('/logout', 'LoginController@logout')->name('logout');

// Routing Admin 
Route::prefix('admin')
	->namespace('Admin')
	->middleware('admin')
	->group(function () {

		Route::get('/', 'AdminController@index')->name('dashboard-admin');
		Route::POST('/admin/store', 'AdminController@store')->name('store-admin');
		Route::DELETE('/admin/store/{id}', 'AdminController@destroy')->name('destroy-admin');
		Route::GET('/admin/{id}/edit', 'AdminController@edit')->name('edit-admin');
		Route::PUT('/admin/update/{id}', 'AdminController@update')->name('update-admin');
		Route::resource('/rw', 'RwController');
		Route::get('/cities/{province_id}', 'RwController@getCities');
		Route::get('/kec/{kota_id}', 'RwController@getKecamatan');
		Route::get('/kel/{kelurahan_id}', 'RwController@getKelurahan');
		Route::resource('/kelurahan', 'KelurahanController');
		Route::resource('/kecamatan', 'kecamatanController');
		Route::resource('/kota', 'kotaController');
		Route::resource('/provinsi', 'ProvinsiController');
	});

// Routing RW
Route::prefix('rw')
	->namespace('Rw')
	->middleware('rw')
	->group(function() {
		Route::get('/', 'RwController@index')->name('dashboard-rw');
		Route::resources([
			'warga' => 'WargaController'
		]);

		// Get File
		Route::get('/file/{file}', 'WargaController@fileWarga');
	});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
