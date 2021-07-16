<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Session;

class Authenticate
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
        $exception = [
            "/",
            "login",
        ];

        if ( !in_array($request->route()->uri, $exception) && empty(Session::get('user'))) {
            return redirect('/');
        }else if ( !empty(Session::get('user')) && in_array($request->route()->uri,$exception) ){
            return redirect('/home');
        }

        return $next($request);
        
    }
}
