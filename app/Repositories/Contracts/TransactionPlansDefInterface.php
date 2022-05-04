<?php

namespace App\Repositories\Contracts;

interface TransactionPlansDefInterface
{
    public function all();
    public function create($request);
}
