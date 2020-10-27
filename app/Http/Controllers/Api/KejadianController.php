<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\{LaporanKejadian, ParamKejadian};
use Validator;
use Exception;
use Str;

class KejadianController extends Controller
{

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	// Validasi
	private function rules()
	{
		return [
			'fk_rw_id' => 'required',
			'fk_param_id' => 'required',
			'tanggal_kejadian' => 'required',
			'keterangan' => 'required',
			'longtitude' => 'required',
			'latitude' => 'required',
			'foto_kejadian' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
		];
	}

	/**
     * Create Kejadian.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
	public function insertKejadian(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		$warga_id = $request->get('auth_data')->warga_id; // ID Warga ngambil dari token dan di regis di middleware jwt auth
		try {

			$validator = Validator::make($request->all(), $this->rules());

			if ($validator->fails()) {
				return response()->json($validator->errors());
			}

			if ($request->file('foto_kejadian')) {

				$foto_kejadian = Str::random(9);
				$request->file('foto_kejadian')->move(storage_path('image/kejadian'), $foto_kejadian);

				$kejadian = LaporanKejadian::create([
					'fk_user_id' => $warga_id,
					'fk_rw_id' => $request->fk_rw_id,
					'fk_param_id' => $request->fk_param_id,
					'tanggal_kejadian' => $request->tanggal_kejadian,
					'keterangan' => $request->keterangan,
					'longtitude' => $request->longtitude,
					'latitude' => $request->latitude,
					'foto_kejadian' => $foto_kejadian,
					'status' => "Pending",
					'deleted_at' => date('Y-m-d H:i:s')
				]);

				return response()->json([
					'status' => 200,
					'msg' => 'Success Create Kejadian',
					'data' => $kejadian
				], 200);

			} else {

				$kejadian = LaporanKejadian::create([
					'fk_user_id' => $warga_id,
					'fk_rw_id' => $request->fk_rw_id,
					'fk_param_id' => $request->fk_param_id,
					'tanggal_kejadian' => $request->tanggal_kejadian,
					'keterangan' => $request->keterangan,
					'latitude' => $request->latitude,
					'longtitude' => $request->longtitude,
					'status' => "Pending",
					'deleted_at' => date('Y-m-d H:i:s')
				]);

				return response()->json([
					'status' => 200,
					'msg' => 'Success Create Kejadian',
					'data' => $kejadian
				], 200);
			}

		} catch (Exception $e) {
			return response()->json([
				'msg' => 'Invalid Request, Please Refresh !'
			], 500);
		}
	}

	/*
	`* Get Param Kejadian And Kejadian
	*/
	public function GetParamKejadian($param_id)
	{
		try {
			$data = ParamKejadian::findOrFail($param_id);

			if ($data != null) {

				return response()->json([
					'status' => 200,
					'msg' => 'Success',
					'data' => $data
				], 200);
			}

			return response()->json([
				'status' => 400,
				'msg' => 'Opss ! Data is Null'
			], 200);

		} catch (Exception $e) {
			return response()->json([
				'status' => 404,
				'msg' => 'Param Kejadian ID ' . $param_id . ' Not Found !'
			], 404);
		}
	}

	/*
	* Get All Param Kejadian
	*/
	public function GetAllParamKejadian()
	{
		$getAll = ParamKejadian::all();

		if ($getAll != null) {

			return response()->json([
				'status' => 200,
				'msg' => 'Success',
				'data' => $getAll
			], 200);
		}

		return response()->json([
			'status' => 401,
			'msg' => 'Opss ! Data is Null'
		], 401);
	}

	/*
    * Buat Ngelihat File Image Nya / Get File Image Nya 
    */
	public function FileKejadian($file)
	{
		$avatar_path = storage_path('image/kejadian') . '/' . $file;

		if (file_exists($avatar_path)) {
			$file = file_get_contents($avatar_path);
			return response($file, 200)->header('Content-Type', 'image/jpeg');
		}

		return response()->json([
			'status' => 500,
			'msg' => 'File Not Found !'
		], 500);
	}
}
