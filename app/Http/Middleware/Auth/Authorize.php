<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Session;

class Authorize
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
            "logout",
            "login",
            "{fallbackPlaceholder}",
        ];

        if( !in_array($request->route()->uri, $exception) ) {
            $authorize = false;
            foreach (Session::get('menus') as $menu) {
                foreach ($menu->children_menus as $subMenu) {
                    if( strpos($subMenu->menu_link, $request->route()->uri) ) 
                        $authorize = true;
                }
            }

            if(!$authorize) {
                return redirect('/home');
            }
        }

        return $next($request);
    }
}
