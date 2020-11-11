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

Route::GET('/', 'LoginController@index')->name('login-admin'); // Login View
Route::POST('/login-admin', 'LoginController@postlogin')->name('postLogin'); // Login Process
Route::GET('/register', 'LoginController@registerRW')->name('register-rw'); // Register View
Route::POST('/register', 'LoginController@registerRWProcess')->name('register-rw-process'); // Register Process
Route::get('/logout', 'LoginController@logout')->name('logout'); // Logiut
Route::get('pembayaran/{id_rw}', 'LoginController@pembayaran')->name('pembayaran'); // Pembayaran

/*
* Get Provinsi, Kec, Kota, Desa
*/
Route::get('kota/{province_id}', 'LoginController@getCities');
Route::get('kecamatan/{kota_id}', 'LoginController@getKecamatan');
Route::get('kelurahan/{kelurahan_id}', 'LoginController@getKelurahan');

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
		Route::resource('/tagihan', 'TagihanController');
		Route::resource('/tarif', 'TarifController');
		Route::resource('/pembayaran', 'PembayaranController');
		Route::resource('/paramkejadian', 'ParamKejadianController');
		Route::resource('/laporankejadian', 'LaporanKejadianController');
	});

// Routing RW
Route::prefix('rw')
	->namespace('Rw')
	->middleware('rw')
	->group(function () {
		Route::get('/', 'RwController@index')->name('dashboard-rw');
		Route::resources([
			'warga' => 'WargaController',
			'kejadianwarga' => 'KejadianWargaController',
			'tagihan-warga' => 'TagihanControllerWarga',
			'pembayaran-warga' => 'PembayaranControllerWarga',
			'jalan-rw' => 'JalanController',
			'petugas-rw' => 'PetugasController',
		]);

		Route::post('/pembayaran/bayar/{id_pembayaran}', 'WargaController@ProcessBayarPembayaran')->name('bayar-pembayaran');
		Route::GET('/mapsWarga', 'WargaController@show');
		Route::GET('/mapsWarga', 'RwController@aktif')->name('belum-aktif');

		// Get File
		Route::get('file/{file}', 'WargaController@fileWarga'); // Get File Warga
		Route::get('file/pembayaran/{file}', 'WargaController@filePembayaran'); // Get File Pembayaran
	});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
