<?php

namespace App\Http\Middleware;

use Closure;

class AddHeaders
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

        // $response = $next($request);
        // $response->header('Access-Control-Allow-Origin', env('APP_URL'));
        // $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
        // $response->header('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept');
    
        // return $response;

    }

}
