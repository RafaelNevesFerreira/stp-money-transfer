<?php

namespace App\Pipes;

use Closure;

class Garages
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled("garage"), function ($query) {
            if (request("garage") == "oui") {
                $garage = 1;
            }else{
                $garage = 0;
            }

            $query->where("garage", $garage);
        });

        return $next($query);
    }
}
