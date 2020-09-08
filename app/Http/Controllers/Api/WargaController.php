<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Warga;
use Str;
use Validator;

class WargaController extends Controller
{
	
	public function __construct(Request $request)
    {
        $this->request = $request;
        $this->getToken = new LoginController;
    }

    // Validasi Rules Update Data
    private function rules()
    {
        return [
            'fk_rw_id' => 'required',
            'email' => 'required|email',
            'nama' => 'required',
            'phone' => 'required|string',
            'alamat' => 'required|string',
            'foto_ktp' => 'mimes:jpeg,jpg,png|required|max:10000',
            'foto_kk' => 'mimes:jpeg,jpg,png|required|max:10000',
            'foto_profile' => 'mimes:jpeg,jpg,png|required|max:10000',
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
                'password' => Hash::make($request->password),
                'phone' => $request->phone
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

    // Get Warga By ID
    public function GetIDWarga($warga_id)
    {
        try {

            $edit_warga = Warga::findOrFail($warga_id);

            if ($edit_warga != null) {
                
                return response()->json([
                    'status' => 200,
                    'data' => $edit_warga
                ], 200);
            }

            return response()->json([
                "msg" => 'Data Warga Tidak Ada'
            ], 401);
            
        } catch (Exception $e) {

            return response()->json([
                "msg" => 'Invalid Request !'
            ], 500);
        }
    }

    // Update Data Warga
    public function updateData(Request $request, $warga_id)
    {
        $file = Warga::where('warga_id', $warga_id)->first();
    	
        try {

            // Validasi
    		$validator = Validator::make($request->all(), $this->rules());
    		if ($validator->fails()) {
    			return response()->json($validator->errors());
    		}

    		if ($request->input('password')) {

                // Check Jika File Nya Null Dia Akan Create Data
                if (empty($file->foto_ktp && $file->foto_kk && $file->foto_profile)) {
                    
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
                        'foto_kk' => $foto_kk,
                        'foto_profile' => $foto_profile,
                    );

                    Warga::find($warga_id)->update($warga_update);

                    return response()->json([
                        'status' => 200,
                        'data' => $warga_update
                    ], 200);

                }else{

                    // Check Jika File Kosong
                    if (!empty($_FILES)) {

                        // Check Jika Data File nya ada di Database dan di Folder Storange dia akan unlink lalu update data
                        if (storage_path('image/' .$file->foto_ktp) && storage_path('image/' .$file->foto_kk) && storage_path('image/' .$file->foto_profile)) {

                            unlink(storage_path('image/' . $file->foto_ktp));
                            unlink(storage_path('image/' . $file->foto_kk));
                            unlink(storage_path('image/' . $file->foto_profile));
                        }

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
                            'foto_kk' => $foto_kk,
                            'foto_profile' => $foto_profile,
                        );

                        Warga::find($warga_id)->update($warga_update);

                        return response()->json([
                            'status' => 200,
                            'data' => $warga_update
                        ], 200);

                    }else{

                        return response()->json([
                            'status' => 400,
                            'msg' => 'FILES is null !'
                        ], 400);
                    }
                }

            }else {

                // Check Jika File Nya Null Dia Akan Create Data
                if (empty($file->foto_ktp && $file->foto_kk && $file->foto_profile)) {
                    
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

                }else{

                    // Check Jika File Nya Kosong
                    if (!empty($_FILES)) {

                        // Check Jika Data File nya ada di Database dan di Folder Storange dia akan unlink lalu update data
                        if (storage_path('image/' .$file->foto_ktp) && storage_path('image/' .$file->foto_kk) && storage_path('image/' .$file->foto_profile)) {

                            unlink(storage_path('image/' . $file->foto_ktp));
                            unlink(storage_path('image/' . $file->foto_kk));
                            unlink(storage_path('image/' . $file->foto_profile));
                        }

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

                    }else{

                        return response()->json([
                            'status' => 400,
                            'msg' => 'Failed Update Data !'
                        ], 400);
                    }
                }
            }

    	} catch (Exception $e) {

    		return response()->json([
                "msg" => 'Invalid Request !'
            ], 500);
    	}
    }

    // Delete Warga
    public function deleteWarga($warga_id)
    {
        try {

            $delete_data = Warga::findOrFail($warga_id);
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
                "msg" => 'Invalid Request !'
            ], 500);
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

    	return response()->json([
            'status' => 500,
            'msg' => 'File Not Found !'
        ], 500);
    }
}

?>