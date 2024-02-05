<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;


class ActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->isActive($request)){
            return $next($request);
        }else{
            throw new AuthorizationException();
        }
    }
    public function isActive(Request $request){
        if($request->session()->has('session_user')){
            return true;
        }else{
            return false;
        }
    }
}
