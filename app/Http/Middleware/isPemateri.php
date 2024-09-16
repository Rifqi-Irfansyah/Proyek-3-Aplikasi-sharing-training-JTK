<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isPemateri
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // logic Must be Pemateri
        if(!auth()->check() || auth()->user()->role !== 'pemateri'){
            abort (403);
        }
        return $next($request);
    }
}
