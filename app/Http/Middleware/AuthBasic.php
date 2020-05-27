<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AuthBasic
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
        //if user is not authenticated
        if(Auth::onceBasic()){ //used to identify cookies in a session
            return response()->json(['message' => 'Auth not Authenticated!'], 401);
        }

        return $next($request);
        
        
    }
}
