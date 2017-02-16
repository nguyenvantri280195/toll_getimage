<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class LoginMiddleware
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
        if(Auth::check()){
            $user = Auth::user();
            return $next($request);
           /* if($user->id==1){
                return $next($request);  
            }
            else{
                return redirect('/login');
            }*/
       }else{
            return redirect('/login');
       }
    }
}
