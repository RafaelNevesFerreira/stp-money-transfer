<?php

namespace App\Pipes;

use Closure;

class PriceFilter
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled("price"), function ($query) {
            $price = explode(";", request("price"));
            if ($price[0] != $price[1]) {
                $query->whereBetween("price", [$price]);
            }else{
                $query->where("price",">",$price[0]);
            }
        });

        return $next($query);
    }
}
