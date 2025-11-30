<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateJwtCustom {
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Your session has expired. Please login again.'
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid authentication token.'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Authorization token not provided.'
            ], 400);
        }

        return $next($request);
    }
}