<?php

namespace App\Http\Controllers\Api;

use App\Warga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Str;
use Validator;

class WargaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->getToken = new LoginController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $warga = Warga::all();

            return response()->json([
                'status' => 200,
                'data' => $warga
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status' => 401,
                'msg' => 'Failed read data'
            ], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $rules = [
                'fk_rw_id' => 'required',
                'email' => 'required|email|unique:tbl_warga',
                'nama' => 'required',
                'password' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = Warga::create([
                'fk_rw_id' => $request->fk_rw_id,
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone
            ]);

            return response()->json([
                'status' => 200,
                'data' => $data
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                "msg" => 'error'
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $edit_warga = Warga::findOrFail($id);

            if ($edit_warga) {
                return response()->json([
                    'status' => 200,
                    'data' => $edit_warga
                ], 200);
            } else {
                return response()->json([
                    "msg" => 'Data Warga Tidak Ada'
                ], 401);
            }
        } catch (Exception $e) {

            return response()->json([
                "msg" => 'error'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $delete_data = Warga::findOrFail($id);
            $delete_data->delete();

            if ($delete_data != null) {

                $delete_data->delete();
                return response()->json([
                    'status' => 200,
                    'msg' => 'Success Delete Data User'
                ]);
            }

            return response()->json([
                'status' => 401,
                'msg' => 'Wrong ID User'
            ], 401);
        } catch (Exception $e) {

            return response()->json([
                "msg" => 'error'
            ], 401);
        }
    }

    public function updateData(Request $request, $warga_id)
    {
        try {

            $rules = [
                'fk_rw_id' => 'required',
                'email' => 'required|email',
                'nama' => 'required',
                'phone' => 'required|string',
                'alamat' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            if ($request->input('password')) {

                $foto_ktp = Str::random(9);
                $request->file('foto_ktp')->move(storage_path('image'), $foto_ktp);
                $foto_kk = Str::random(9);
                $request->file('foto_kk')->move(storage_path('image'), $foto_kk);
                $foto_profile = Str::random(9);
                $request->file('foto_profile')->move(storage_path('image'), $foto_profile);

                $warga_update = array(
                    'fk_rw_id' => $request->fk_rw_id,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'alamat' => $request->alamat,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'user_id' => $request->user_id,
                    'foto_ktp' => $foto_ktp,
                    'foto_kk' => $request->foto_kk,
                    'foto_profile' => $request->foto_profile,
                );

                Warga::find($warga_id)->update($warga_update);

                return response()->json([
                    'status' => 200,
                    'data' => $warga_update
                ], 200);
            } else {

                $foto_ktp = Str::random(9);
                $request->file('foto_ktp')->move(storage_path('image'), $foto_ktp);
                $foto_kk = Str::random(9);
                $request->file('foto_kk')->move(storage_path('image'), $foto_kk);
                $foto_profile = Str::random(9);
                $request->file('foto_profile')->move(storage_path('image'), $foto_profile);

                $warga_update = array(
                    'fk_rw_id' => $request->fk_rw_id,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'alamat' => $request->alamat,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'user_id' => $request->user_id,
                    'foto_ktp' => $foto_ktp,
                    'foto_kk' => $foto_kk,
                    'foto_profile' => $foto_profile,
                );

                Warga::find($warga_id)->update($warga_update);

                return response()->json([
                    'status' => 200,
                    'data' => $warga_update
                ], 200);
            }
        } catch (Exception $e) {

            return response()->json([
                "msg" => 'error'
            ], 401);
        }
    }

    // Buat Ngelihat File Image Nya / Get File Image Nya 
    public function fileMateri($file)
    {
        $avatar_path = storage_path('image') . '/' . $file;

        if (file_exists($avatar_path)) {
            $file = file_get_contents($avatar_path);
            return response($file, 200)->header('Content-Type', 'image/jpeg');
        }

        return "Data File Tidak Di Temukan";
    }
}
