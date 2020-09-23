<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\LoginController;
use App\LaporanKejadian;
use App\ParamKejadian;
use Str;
use Validator;


class KejadianController extends Controller
{

	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->getToken = new LoginController;
	}

	// Validasi
	private function rules()
	{
		return [
			'fk_rw_id' => 'required',
			'fk_param_id' => 'required',
			'tanggal_kejadian' => 'required',
			'keterangan' => 'required',
		];
	}

	// Create Kejadian
	public function insertKejadian(Request $request)
	{
		date_default_timezone_set('Asia/Jakarta');
		$warga_id = $this->getToken->getID($request);

		try {

			$validator = Validator::make($request->all(), $this->rules());

			if ($validator->fails()) {
				return response()->json($validator->errors());
			}

			$kejadian = LaporanKejadian::create([
				'fk_user_id' => $warga_id,
				'fk_rw_id' => $request->fk_rw_id,
				'fk_param_id' => $request->fk_param_id,
				'tanggal_kejadian' => $request->tanggal_kejadian,
				'keterangan' => $request->keterangan,
				'status' => "Pending",
				'deleted_at' => date('Y-m-d H:i:s')
			]);

			if ($kejadian != null) {
				return response()->json([
					'status' => 200,
					'msg' => 'Success Create Kejadian',
					'data' => $kejadian
				], 200);
			}

			return response()->json([
				'status' => 401,
				'msg' => 'Failed Insert Kejadian'
			], 401);
		} catch (Exception $e) {

			return response()->json([
				'msg' => 'Invalid Request'
			], 500);
		}
	}

	// Get Param Kejadian And Kejadian
	public function GetParamKejadian($param_id)
	{
		$data = LaporanKejadian::with('ParamKejadian')->where('kejadian_id', $param_id)->get();

		if ($data != null) {

			return response()->json([
				'status' => 200,
				'msg' => 'Success',
				'data' => $data
			], 200);
		}

		return response()->json([
			'status' => 401,
			'msg' => 'Opss ! Data is Null'
		], 401);
	}

	// Get All Param Kejadian
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
}
