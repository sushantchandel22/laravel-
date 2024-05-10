<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->user());
        if($request->user() && $request->user()->isadmin){
            return $next($request);
        }
        elseif($request->user() && $request->user()->role_id === 2){
            return redirect('/profile');
        }
       return redirect('/login');
    }
}
