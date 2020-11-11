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

// Auth Controller
Route::group(['namespace' => 'Api'], function () {
	Route::POST('/login', 'LoginController@index'); // Login
	Route::POST('/login/petugas-rw', 'LoginController@PetugasRWLogin'); // Login Petugas RW
	Route::POST('/warga-register', 'WargaController@register'); // Register
	Route::GET('/Rw-all', 'WargaController@GetRw'); // Get All RW
	Route::GET('/logout', 'LoginController@logout'); // Logout
});
Route::group(['middleware' => ['jwt.auth'], 'namespace' => 'Api'], function () {

	// Get tbl_pb
	Route::GET('/pb', 'PBController@Getpb'); // Get All TBL PB
	
	// Laporan tbl_pb_laporan
	Route::POST('/laporan-pb/create', 'PBController@CreateLaporanPB'); // Insert Laporan PB
	Route::GET('/laporan-pb/all', 'PBController@GetAllLaporanPB'); // Insert Laporan PB

	// Warga Controller
	Route::GET('warga', 'WargaController@index'); // Get All Warga
	Route::GET('warga/edit/{warga_id}', 'WargaController@GetIDWarga'); // Get Warga Per ID
	Route::POST('warga/update/{warga_id}', 'WargaController@updateData'); // Update Warga Process 
	Route::DELETE('warga/delete/{warga_id}', 'WargaController@deleteWarga'); // Delete Warga Process

	// Kejadian Controller
	Route::POST('kejadian', 'KejadianController@insertKejadian'); // Insert Kejadian
	Route::GET('kejadian/param_kejadian/{param_id}', 'KejadianController@GetParamKejadian'); // Get Param Kejadian
	Route::GET('kejadian/param_kejadian', 'KejadianController@GetAllParamKejadian'); // Get All Param Kejadian
	Route::GET('image/kejadian/{file}', 'KejadianController@FileKejadian'); // Get File Kejadian

	// File Get Name
	Route::GET('image/{file}', 'WargaController@fileWarga'); // Get File Warga
});
