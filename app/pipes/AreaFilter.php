<?php

namespace App\Pipes;

use Closure;

class AreaFilter
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled("max_area"), function ($query) {

            $query->where("area","<" ,request("max_area"));

        });

        $query->when(request()->filled("min_area"), function ($query) {

            $query->where("area",">" ,request("min_area"));

        });

        return $next($query);
    }
}
