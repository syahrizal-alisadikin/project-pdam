<?php

namespace App\Http\Controllers\Api;

use App\{Warga, PetugasRw};
use App\Rw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;
use Exception;
use Validator;

class LoginController extends Controller
{

    // Jwt
    public function jwt($user)
    {

        $payload = [
            'iss' => 'lumen-jwt', // Issuer of the token, Organization / Product
            'sub' => $user,  // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60 * 1440 // Expiration time 1 day
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }

    //Get ID JWT
    public function getID($request)
    {
        $header = $request->header('Authorization');
        $ex = explode(" ", $header);
        $exx = explode(".", $ex[1]);
        $base_64 = base64_decode($exx[1]);
        $json = json_decode($base_64);

        return $json->sub->warga_id;
    }

    // Login Method
    public function index(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $where = [
                'email' => $request->email,
            ];

            $data = Warga::select(['warga_id', 'fk_rw_id', 'nama', 'email', 'phone', 'password'])->where($where)->first();

            if (!$data || !Hash::check($request->password, $data->password)) {
                return response([
                    'success'   => false,
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'data' => $data,
                'token' => $this->jwt($data)
            ], 200);

        } catch (Exception $e) {
            return response([
                'success'   => false,
                'message' => ['Bat error request.']
            ], 500);
        }
    }

    /*
    * Login Petugas RW
    */
    public function PetugasRWLogin(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $loginType = preg_match('/^\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/', $request->phone) ? 'phone' : 'nama';

            $petugas_rw_login = PetugasRw::where([$loginType => $request->phone])->first();

            if (!$petugas_rw_login || !Hash::check($request->password, $petugas_rw_login->password)) {
                return response([
                    'success'   => false,
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'data' => $petugas_rw_login,
                'token' => $this->jwt($petugas_rw_login)
            ], 200);

        } catch (Exception $e) {

            print_r($e->getMessage()); 
        }
    }

    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        if (session_destroy()) {
            return redirect('/login');
        }
    }
}
