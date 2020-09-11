<?php

namespace App\Http\Controllers\Api;

use App\Warga;
use App\Rw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{

    // Jwt
    public function jwt($user){

        $payload = [
            'iss' => 'lumen-jwt', // Issuer of the token, Organization / Product
            'sub' => $user,  // Subject of the token
            // 'iat' => time(), // Time when JWT was issued. 
            // 'exp' => time() + 60 * 60 // Expiration time 60 minute
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
                
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

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
