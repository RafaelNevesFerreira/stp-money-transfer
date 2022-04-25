<?php

namespace App\Pipes;

use Closure;

class Bathrooms
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled("bathrooms"), function ($query) {

            $query->where("bathrooms",request("bathrooms"));

        });

        return $next($query);
    }
}
