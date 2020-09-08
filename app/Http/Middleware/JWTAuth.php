<?php
namespace App\Http\Middleware;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Closure;
use Exception;

class JWTAuth
{   

    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('authorization');
        $verifiy    = explode(" ", $token);

        if($verifiy[0] !== 'pdam'){

            $response = [
                'code' => 401,
                'error' => 'Token not provided.'
            ];

            return response()->json($response, 401);
        }

        if(!$token) {
            
            $response = [
                'code' => 400,
                'error' => 'Provided token is expired.'
            ];

            return response()->json($response, 400);
        }
        try {

            $credentials = JWT::decode($verifiy[1], env('JWT_SECRET'), ['HS256']);
            
        } catch(ExpiredException $e) {

            $response = [
                'code' => 401,
                'error' => 'Token is expired. '
            ];

            return response()->json($response, 401);

        } catch(Exception $e) {
            
            $response = [
                'code' => 400,
                'error' => 'An error while decoding token.'
            ];

            return response()->json($response, 400);
        }

        return $next($request);
    }
}