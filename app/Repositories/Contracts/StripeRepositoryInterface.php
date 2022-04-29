<?php

namespace App\Repositories\Contracts;


interface StripeRepositoryInterface
{
    public function count_customers($month = null);
    public function count_payments($month);
}
