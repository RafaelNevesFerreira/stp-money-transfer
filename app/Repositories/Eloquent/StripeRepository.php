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

    public function count_customers()
    {
        $stripe = new \Stripe\StripeClient("sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId");

        // $date = new DateTime("2022-04-26");

        $customers = $stripe->paymentIntents->all();
        $count = 0;

        foreach ($customers->autoPagingIterator() as $customer) {
            $count += 1;
        }

        return $count;
    }
}
