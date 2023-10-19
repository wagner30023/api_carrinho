<?php

//use \Tymon\JWTAuth\Facades\JWTAuth;

class  MyJwtMiddleware
{
    /**
     *  Handle an incoming request
     *
     * @param \Illuminate\Http\Request $request
     * @para \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['message' => 'Token inválido']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['message' => 'Token expirado']);
            } else {
                return response()->json(['message' => 'Token de autorização não encontrado']);
            }
        }
        return $next($request);
    }
}
