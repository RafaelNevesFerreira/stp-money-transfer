<?php

namespace App\Pipes;

use Closure;

class StatusFilter
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled('filter'), function ($query) {
            $filter = request('filter');
            if ($filter === "cash") {
                $query->where('payment_method', "cash");
            } elseif ($filter === "card") {
                $query->where('payment_method', "card");
            } else {
                $query->where("status", $filter);
            }
        });

        return $next($query);
    }
}
