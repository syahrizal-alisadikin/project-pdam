<?php 

namespace App\Http\Middleware;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Closure;
use Exception;

class JWTAuth {

	public function handle($request, Closure $next)
	{
		$token = $request->header('Authorization');
		$verify = explode(" ", $token);

		if ($verify[0] !== "pdam") {

			return response()->json([
				'code' => 401,
				'error' => 'Token not provided.'
			]);
		}

		if (!$token) {

			return response()->json([
                'code' => 400,
                'error' => 'Provided token is expired.'
            ]);
		}

		try {
			
			$credentials = JWT::decode($verify[1], env('JWT_SECRET'), ['HS256']);
		
		} catch(ExpiredException $e) {


			return response()->json([
                'code' => 400,
				'error' => 'Token is expired. '
            ]);
		} catch(Exception $e) {

			return response()->json([
				'code' => 400,
				'error' => 'An error while decoding token.'
			]);
		}

		return $next($request);

	}
}

?>