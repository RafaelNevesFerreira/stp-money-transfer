<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\StripeRepositoryInterface;
use DateTime;

class StripeRepository implements StripeRepositoryInterface
{
    public function __construct()
    {
        $this->model = new \Stripe\StripeClient("sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId");
    }

    public function count_customers($month = null)
    {
        $stripe = new \Stripe\StripeClient("sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId");

        //mes passado
        if ($month != date("m")) {
            $date = new DateTime(date("Y-$month-01"));
            $este_mes = new DateTime(date("Y-m-31"));

            $customers = $stripe->customers->all(["created" => ["gte" => $este_mes->getTimestamp(), "lte" =>  $date->getTimestamp()]]);
        }
        //esse mes
        else {
            $date = new DateTime(date("Y-$month-01"));
            $este_mes = new DateTime(date("Y-m-31"));
            $customers = $stripe->customers->all(["created" => ["gte" => $date->getTimestamp(), "lte" => $este_mes->getTimestamp()]]);
        }

        $count = 0;

        foreach ($customers->autoPagingIterator() as $customer) {
            $count += 1;
        }

        return $count;
    }

    public function count_payments($month = null)
    {
        $stripe = new \Stripe\StripeClient("sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId");

        //mes passado
        if ($month != date("m")) {
            $date = new DateTime(date("Y-$month-01"));
            $este_mes = new DateTime(date("Y-m-30"));

            $paymentIntents = $stripe->paymentIntents->all(["created" => ["gte" => $date->getTimestamp(), "lte" =>  $este_mes->getTimestamp()]]);
        }
        //esse mes
        else {
            $date = new DateTime(date("Y-$month-01"));
            $este_mes = new DateTime(date("Y-m-30"));
            $paymentIntents = $stripe->paymentIntents->all(["created" => ["gte" => $date->getTimestamp(), "lte" => $este_mes->getTimestamp()]]);
        }

        $count = 0;

        foreach ($paymentIntents->autoPagingIterator() as $customer) {
            $count += 1;
        }

        return $count;
    }
}
