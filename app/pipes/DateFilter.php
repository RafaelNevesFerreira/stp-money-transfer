<?php

namespace App\Pipes;

use Closure;
use DateTime;
use Illuminate\Support\Carbon;

class DateFilter
{
    public function handle($query, Closure $next)
    {
        $query->when(request()->filled("date"), function ($query) {
            $memes = explode("-", request("date"));

            $date[0] = new DateTime(trim(str_replace("/", "-", $memes[0])));
            $date[1] = new DateTime(trim(str_replace("/", "-", $memes[1])));

            $data = $date[0]->format('d')+ 1;

            if ($date[0] == $date[1]) {
                $query->where('created_at', ">=", $date[0]->format('Y-m-d'))->where('created_at', "<", date("Y-m-$data"));
            } else {
                $dates = date_create($date[1]->format('Y-m-d'));

                $date[1] = date_add($dates, date_interval_create_from_date_string("1 day"));
                $query->whereBetween('created_at', [$date[0]->format('Y-m-d'), $date[1]->format('Y-m-d')]);
            }
        });

        return $next($query);
    }
}
