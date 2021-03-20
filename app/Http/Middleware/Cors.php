<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //Url a la que se le dará acceso en las peticiones
        return $next($request)
        		->header("Access-Control-Allow-Origin", "*")
        		->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE")
        		->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization");
      //Métodos que a los que se da acceso

      //Headers de la petición

    }
}
