<?php

namespace App\Http\Middleware;
use Closure;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;


class JwtMiddleware 
{

	public function handle($request, Closure $next)
	{
		try {
		   JWTAuth::parseToken()->authenticate();
 		} catch (Exception $e) {
        	  if ($e instanceof TokenInvalidException){
		    return response()->json(['status' => 'Token is Invalid'], 403);
		  }else if ($e instanceof TokenExpiredException){
			return response()->json(['status' => 'Token is Expired'], 401);
		  }else if ($e instanceof TokenExpiredException){
			return response()->json(['status' => 'Token is Blacklisted'], 400);
		  }else{
		        return response()->json(['status' => 'Authorization Token not found'], 404);
		  }
		}
            return $next($request);
	}
}