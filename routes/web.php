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

Route::prefix('admin')
	->namespace('Admin')
	->middleware('admin')
	->group(function () {

		Route::get('/', 'AdminController@index')->name('dashboard-admin');
		Route::POST('/admin/store', 'AdminController@store')->name('store-admin');
		Route::resource('/rw', 'RwController');
		Route::resource('/kelurahan', 'KelurahanController');
		Route::resource('/kecamatan', 'kecamatanController');
		Route::resource('/kota', 'kotaController');
		Route::resource('/provinsi', 'ProvinsiController');
	});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
