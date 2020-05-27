<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $token = $request->header('APP_KEY');

        if($token != 'ABCDEFGHIJ'){

            return response()->json(['message'=> 'User Authentication Failed'], 401); // 401 : unauthorized user authentication (header must start with www)
        }
        return $next($request);
    }
}
