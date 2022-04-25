<?php

namespace App\Pipes;

use Closure;

class StatusFilter
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled('filter'), function ($query) {
            $filter = request('filter');
            $query->where('status', $filter);
        });

        return $next($query);
    }
}
