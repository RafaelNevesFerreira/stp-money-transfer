<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardMiddleware
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
        dd(Auth::check(), Auth::user()->role);
        if (Auth::check() && Auth::user()->role === 1) {
            return redirect()->route("profile.dashboard");
        } elseif (Auth::check() && Auth::user()->role === 2) {
            return redirect()->route("tecnico.dashboard");
        } elseif (Auth::check() && Auth::user()->role === 3) {
            return redirect()->route("admin.dashboard");
        } elseif (!Auth::check()) {
            return redirect()->route("login");
        } else {
            return redirect()->route("home");
        }
    }
}
