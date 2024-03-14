<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->hasRole('Administrator')) {
            return $next($request);
        } else {
            // return redirect()->back()->with('error', 'You are not allowed to access this page');
            session()->flush();
            return redirect()->route('user.login')->with('error', 'You are not allowed to access this page');
        }
    }
}
