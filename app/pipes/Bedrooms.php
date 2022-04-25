<?php

namespace App\Pipes;

use Closure;

class Bedrooms
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled("bedrooms"), function ($query) {

            $query->where("bedrooms",request("bedrooms"));

        });

        return $next($query);
    }
}
