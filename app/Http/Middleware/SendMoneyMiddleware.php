<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SendMoneyMiddleware
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
        if (session("total") && session("tax") && session("valor_a_ser_enviado") && session("moeda")) {
            return $next($request);
        }else{
            return redirect()->route("send");
        }

    }
}
