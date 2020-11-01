<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Warga;
use App\Rw;
use Str;
use Validator;
use Exception;

class WargaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // Api Register Warga
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), $this->rules_register());

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $data = Warga::create([
                'fk_rw_id' => $request->fk_rw_id,
                'nama' => $request->nama,
                'email' => $request->email,
                'latitude' => $request->latitude,
                'longtitude' => $request->longtitude,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'id_rt' => $request->id_rt,
                'gol_darah' => $request->gol_darah,
            ]);

            return response()->json([
                'status' => 200,
                'data' => $data
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                "msg" => 'Invalid Request !'
            ], 500);
        }
    }

    // Validasi Rules Update Data
    private function rules()
    {
        return [
            
        ];
    }

    // Validasi Rules Register
    private function rules_register()
    {
        return [
            'fk_rw_id' => 'required',
            'email' => 'required|email|unique:tbl_warga',
            'nama' => 'required',
            'password' => 'required|string',
        ];
    }

    // Get All Warga
    public function index(Request $request)
    {
        try {

            $warga = Warga::all();

            if ($warga != null) {

                return response()->json([
                    'status' => 200,
                    'data' => $warga
                ], 200);
            }

            return response()->json([
                'status' => 401,
                'data' => 'Data Warga Null'
            ], 401);
        } catch (Exception $e) {

            return response()->json([
                "msg" => 'Invalid Request !'
            ], 500);
        }
    }

    // Get Warga By ID
    public function GetIDWarga($warga_id)
    {
        $edit_warga = Warga::where('warga_id', $warga_id)->first();

        if ($edit_warga != null) {

            return response()->json([
                'status' => 200,
                'data' => $edit_warga
            ], 200);
        }

        return response()->json([
            "msg" => 'Wrong ID Warga ' . $warga_id . ' Not Found !'
        ], 401);
    }

    // Update Data Warga
    public function updateData(Request $request, $warga_id)
    {
        $check_file = Warga::select(['foto_ktp', 'foto_kk', 'foto_profile'])->where('warga_id', $warga_id)->first();
        $id_warga = $request->get('auth_data')->warga_id; // ID Warga ngambil dari token dan di regis di middleware jwt auth 
        
        try {
            
            $validationWarga = Validator::make($request->all(), [
                'fk_rw_id' => 'required',
                'email' => 'required|email',
                'nama' => 'required',
                'phone' => 'required|string',
                'alamat' => 'required|string',
                'longtitude' => 'required|string',
                'latitude' => 'required|string',
                'status' => 'required|string',
                'foto_ktp' => 'mimes:jpeg,jpg,png|max:10000',
                'foto_kk' => 'mimes:jpeg,jpg,png|max:10000',
                'foto_profile' => 'mimes:jpeg,jpg,png|max:10000',
            ]);

            if ($validationWarga->fails()) {
                return response()->json(['status' => 200, 'msg' => 'Validation Errors !', 'error' => $validationWarga->errors()], 200);
            }

            $dataWarga = $validationWarga->validate(); // Validasi

            /* Upload Foto KTP */
            if ($request->file('foto_ktp')) {
                // Pengecekan jika foto_ktp masih kosong datanya
                if (empty($check_file->foto_ktp && storage_path('image/warga/' . $check_file->foto_ktp))) {
                    $foto_ktp = Str::random(9);
                    $request->file('foto_ktp')->move(storage_path('image/warga'), $foto_ktp);
                    $dataWarga['foto_ktp'] = $foto_ktp;

                }else{
                    // Jika Sudah Ada Foto VR_KTP akan di lakukan pengecekan dan menghpus data sblumnya supaya ngak numpuk
                    if (storage_path('image/warga/' . $check_file->foto_ktp)) {
                        // print_r('file ada'); die();
                        unlink(storage_path('image/warga/' . $check_file->foto_ktp));
                        $foto_ktp = Str::random(9);
                        $request->file('foto_ktp')->move(storage_path('image/warga'), $foto_ktp);
                        $dataWarga['foto_ktp'] = $foto_ktp;
                    }else { 
                        
                        return response()->json(['status' => 400, 'msg' => 'Upsss File KTP Not Upload'], 400);
                    }
                }
            }
            /* Upload Foto KK */
            if ($request->file('foto_kk')) {
                // Pengecekan jika foto_kk masih kosong datanya
                if (empty($check_file->foto_kk && storage_path('image/warga/' . $check_file->foto_kk))) {
                    $foto_kk = Str::random(9);
                    $request->file('foto_kk')->move(storage_path('image/warga'), $foto_kk);
                    $dataWarga['foto_kk'] = $foto_kk;

                }else{
                    // Jika Sudah Ada Foto VR_KTP akan di lakukan pengecekan dan menghpus data sblumnya supaya ngak numpuk
                    if (storage_path('image/warga/' . $check_file->foto_kk)) {
                        // print_r('file ada'); die();
                        unlink(storage_path('image/warga/' . $check_file->foto_kk));
                        $foto_kk = Str::random(9);
                        $request->file('foto_kk')->move(storage_path('image/warga'), $foto_kk);
                        $dataWarga['foto_kk'] = $foto_kk;
                    }else { 
                        
                        return response()->json(['status' => 400, 'msg' => 'Upsss File KK Not Upload'], 400);
                    }
                }
            }

            /* Upload Foto Profile */
            if ($request->file('foto_profile')) {
                // Pengecekan jika foto_profile masih kosong datanya
                if (empty($check_file->foto_profile && storage_path('image/warga/' . $check_file->foto_profile))) {
                    $foto_profile = Str::random(9);
                    $request->file('foto_profile')->move(storage_path('image/warga'), $foto_profile);
                    $dataWarga['foto_profile'] = $foto_profile;

                }else{
                    // Jika Sudah Ada Foto VR_KTP akan di lakukan pengecekan dan menghpus data sblumnya supaya ngak numpuk
                    if (storage_path('image/warga/' . $check_file->foto_profile)) {
                        // print_r('file ada'); die();
                        unlink(storage_path('image/warga/' . $check_file->foto_profile));
                        $foto_profile = Str::random(9);
                        $request->file('foto_profile')->move(storage_path('image/warga'), $foto_profile);
                        $dataWarga['foto_profile'] = $foto_profile;
                    }else { 
                        
                        return response()->json(['status' => 400, 'msg' => 'Invalid Request !', 'data' => 'Upsss File Profile Not Upload'], 400);
                    }
                }
            }

            Warga::find($warga_id)->update($dataWarga);
            return response()->json(['status' => 200, 'msg' => 'Success Update Data !', 'data' => $dataWarga], 200);

        }catch (Exception $e) {
            return response()->json(['status' => 500, 'msg' => $e->getMessage()], 500);
        }
    }

    // Delete Warga
    public function deleteWarga($warga_id)
    {
        try {

            $delete_warga = Warga::where('warga_id', $warga_id)->first();

            if ($delete_warga != null) {

                if (storage_path('image/warga/' . $delete_warga->foto_ktp) && storage_path('image/warga/' . $delete_warga->foto_kk) && storage_path('image/warga/' . $delete_warga->foto_profile)) {

                    unlink(storage_path('image/warga/' . $delete_warga->foto_ktp));
                    unlink(storage_path('image/warga/' . $delete_warga->foto_kk));
                    unlink(storage_path('image/warga/' . $delete_warga->foto_profile));
                }

                $delete_warga->delete();
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
                "msg" => 'Invalid Request !'
            ], 500);
        }
    }

    /*
    * Buat Ngelihat File Image Nya / Get File Image Nya 
    */
    public function fileWarga($file)
    {
        $avatar_path = storage_path('image/warga') . '/' . $file;

        if (file_exists($avatar_path)) {
            $file = file_get_contents($avatar_path);
            return response($file, 200)->header('Content-Type', 'image/jpeg');
        }

        return response()->json([
            'status' => 500,
            'msg' => 'File Not Found !'
        ], 500);
    }

    public function GetRw()
    {
        $getAll = Rw::all();

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

// VKoG2FCCn0HY