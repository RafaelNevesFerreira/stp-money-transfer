<?php

namespace App\Pipes;

use Closure;

class VilleFilter
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled("ville"), function ($query) {
            $query->where("city","like",request("ville"));
        })->paginate(6);

        return $next($query);
    }
}
