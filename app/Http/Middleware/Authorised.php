<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Response;

use Illuminate\Http\Request;

class Authorised
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
        return $next($request);
        if(Auth::check()){
             //
        }else{
           
                //return Redirect::to("/")->with('message','Please login to continue!!');
           
        }
   }
        
        
    }

