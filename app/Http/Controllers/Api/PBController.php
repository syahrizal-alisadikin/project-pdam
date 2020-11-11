<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\{LaporanKejadian, ParamKejadian, Pb, LaporanPb};
use Validator;
use Exception;
use Str;

class PBController extends Controller
{
	/*
	* Get All PB 
	*/
	public function Getpb()
	{
		$data = Pb::all();

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

	/*
	* Insert Laporan Table Laporan PB
	*/
    public function CreateLaporanPB(Request $request)
    {
    	try {
    		
    		$validatorLaporan = Validator::make($request->all(), [
    			'nama' => 'required|string',
    			'longtitude' => 'required',
    			'latitude' => 'required',
    			'alamat' => 'required|string',
    			'fk_pb_id' => 'required',
    		]);	

    		if ($validatorLaporan->fails()) {
            	return response()->json([
        			'status' => 'resError',
        			'message' => $validatorLaporan->errors(),
        			'data' => null,
        			'error' => 'Validation failed'
        		], 200);

            }

            $dataLapoaran = $validatorLaporan->validate(); // Validasi
            
            LaporanPb::create($dataLapoaran); // Create Laporan

            return response()->json([
            	'status' => 200,
            	'message' => 'Success Create Laporan PB',
            	'data' => $dataLapoaran
            ]);

    	} catch (Exception $e) {
    		
    		return response()->json([
            	'status' => 500,
            	'message' => 'Invalid Request !',
            	'data' => $e->getMessage()
            ], 500);
    	}
    }

    /*
	* Get All Table Laporan 
    */
    public function GetAllLaporanPB()
    {
    	try {
    		
    		$laporan_data = LaporanPb::all();

    		if ($laporan_data != null) {
    			
    			return response()->json([
            		'status' => 200,
            		'message' => 'Success Get All',
            		'data' => $laporan_data
            	]);
    		}

    		return response()->json([
            	'status' => 200,
            	'message' => 'Failed Get All',
            	'data' => 'Data Is Null'
            ]);

    	} catch (Exception $e) {
    		
    		return response()->json([
            	'status' => 500,
            	'message' => 'Invalid Request !',
            	'data' => $e->getMessage()
            ], 500);
    	}
    }
}
